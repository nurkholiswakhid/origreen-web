<?php

namespace Tests\Feature\Admin;

use App\Models\Testimonial;
use App\Models\User;
use Tests\TestCase;

class TestimonialControllerTest extends TestCase
{
    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::factory()->create([
            'is_admin' => true,
        ]);
    }

    public function test_admin_can_view_testimonials_list()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.testimonials.index'));

        $response->assertStatus(200);
    }

    public function test_admin_can_create_testimonial()
    {
        $data = [
            'name' => 'John Doe',
            'occupation' => 'Developer',
            'content' => 'Great place!',
            'rating' => 5,
            'is_active' => true,
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.testimonials.store'), $data);

        $this->assertDatabaseHas('testimonials', [
            'name' => 'John Doe',
        ]);
    }

    public function test_admin_can_delete_testimonial()
    {
        $testimonial = Testimonial::factory()->create();

        $this->actingAs($this->admin)
            ->delete(route('admin.testimonials.destroy', $testimonial));

        $this->assertDatabaseMissing('testimonials', [
            'id' => $testimonial->id,
        ]);
    }
}
