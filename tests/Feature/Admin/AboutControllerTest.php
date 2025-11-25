<?php

namespace Tests\Feature\Admin;

use App\Models\About;
use App\Models\User;
use Tests\TestCase;

class AboutControllerTest extends TestCase
{
    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::factory()->create([
            'is_admin' => true,
            'email' => 'admin-about-' . uniqid() . '@example.com',
        ]);
    }

    public function test_admin_can_view_about_page()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.about.edit'));

        $response->assertStatus(200);
    }

    public function test_admin_can_update_about_content()
    {
        $about = About::factory()->create([
            'title' => 'Original Title',
            'subtitle' => 'Original Subtitle',
            'description' => 'Original Description',
        ]);

        $data = [
            'title' => 'Updated Title',
            'subtitle' => 'Updated Subtitle',
            'description' => 'Updated Description',
            'stats_visitor' => json_encode(['count' => 5000]),
            'stats_rating' => json_encode(['stars' => 4.5]),
        ];

        $response = $this->actingAs($this->admin)
            ->put(route('admin.about.update'), $data);

        $this->assertDatabaseHas('abouts', [
            'title' => 'Updated Title',
        ]);
    }
}
