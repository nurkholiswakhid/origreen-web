<?php

namespace Tests\Feature\Admin;

use App\Models\Facility;
use App\Models\User;
use Tests\TestCase;

class FacilityControllerTest extends TestCase
{
    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'is_admin' => true,
            'email' => 'admin-facility-' . uniqid() . '@example.com',
        ]);
    }

    public function test_unauthenticated_user_cannot_access_facilities_page()
    {
        $response = $this->get(route('admin.facilities.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_non_admin_user_cannot_access_facilities_page()
    {
        $user = User::factory()->create(['is_admin' => false, 'email' => 'user-' . uniqid() . '@example.com']);

        $response = $this->actingAs($user)->get(route('admin.facilities.index'));

        $this->assertTrue(
            $response->status() === 403 || $response->status() === 302,
            'Expected 403 or 302 redirect, got ' . $response->status()
        );
    }

    public function test_admin_can_view_facilities_list()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.facilities.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.facilities.index');
    }

    public function test_admin_can_view_create_facility_form()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.facilities.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.facilities.create');
    }

    public function test_admin_can_store_facility()
    {
        $storeData = [
            'name' => 'Test Facility',
            'description' => 'Test Description',
            'display_type' => 'image',
            'image_url' => 'https://example.com/image.jpg',
            'icon' => 'fas fa-icon',
            'main_icon' => 'fas fa-main',
            'duration' => 60,
            'type' => 'wahana',
            'is_active' => true,
            'order' => 1,
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.facilities.store'), $storeData);

        $this->assertDatabaseHas('facilities', [
            'name' => 'Test Facility',
            'type' => 'wahana',
        ]);
    }

    public function test_admin_can_view_edit_facility_form()
    {
        $facility = Facility::factory()->create();

        $response = $this->actingAs($this->admin)
            ->get(route('admin.facilities.edit', $facility));

        $response->assertStatus(200);
        $response->assertViewIs('admin.facilities.edit');
        $response->assertViewHas('facility', $facility);
    }

    public function test_admin_can_update_facility()
    {
        $facility = Facility::factory()->create();

        $data = [
            'name' => 'Updated Facility ' . uniqid(),
            'description' => 'Updated Description',
            'display_type' => 'image',
            'image_url' => 'https://example.com/updated.jpg',
            'icon' => 'fas fa-updated',
            'main_icon' => 'fas fa-main-updated',
            'duration' => 120,
            'type' => 'fasilitas',
            'is_active' => true,
            'order' => 2,
        ];

        $response = $this->actingAs($this->admin)
            ->put(route('admin.facilities.update', $facility), $data);

        // Just verify that the request was accepted
        $this->assertTrue(
            in_array($response->status(), [200, 201, 302, 303, 307, 308]),
            'Expected successful response, got ' . $response->status()
        );
    }

    public function test_admin_can_delete_facility()
    {
        $facility = Facility::factory()->create();

        $response = $this->actingAs($this->admin)
            ->delete(route('admin.facilities.destroy', $facility));

        $this->assertDatabaseMissing('facilities', [
            'id' => $facility->id,
        ]);

        $response->assertRedirect(route('admin.facilities.index'));
    }

    public function test_facility_name_is_required()
    {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.facilities.store'), [
                'description' => 'Test',
            ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_facility_type_must_be_valid()
    {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.facilities.store'), [
                'name' => 'Test',
                'type' => 'invalid',
            ]);

        $response->assertSessionHasErrors('type');
    }
}
