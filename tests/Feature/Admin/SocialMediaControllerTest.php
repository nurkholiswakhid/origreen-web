<?php

namespace Tests\Feature\Admin;

use App\Models\SocialMedia;
use App\Models\User;
use Tests\TestCase;

class SocialMediaControllerTest extends TestCase
{
    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::factory()->create([
            'is_admin' => true,
            'email' => 'admin-social-' . uniqid() . '@example.com',
        ]);
    }

    public function test_admin_can_view_social_media_list()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.social-media.index'));

        $response->assertStatus(200);
    }

    public function test_admin_can_create_social_media()
    {
        $uniqueUrl = 'https://facebook-' . uniqid() . '.com/example';
        $data = [
            'platform' => 'FacebookTest' . uniqid(),
            'url' => $uniqueUrl,
            'icon' => 'fab fa-facebook',
            'is_active' => true,
            'sort_order' => 1,
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.social-media.store'), $data);

        // Just check that a social media with this URL exists
        $this->assertDatabaseHas('social_media', [
            'url' => $uniqueUrl,
        ]);
    }

    public function test_admin_can_delete_social_media()
    {
        $social = SocialMedia::factory()->create();

        $this->actingAs($this->admin)
            ->delete(route('admin.social-media.destroy', $social));

        $this->assertDatabaseMissing('social_media', [
            'id' => $social->id,
        ]);
    }
}
