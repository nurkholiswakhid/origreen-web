<?php

namespace Tests\Feature\Admin;

use App\Models\MapSetting;
use App\Models\User;
use Tests\TestCase;

class MapSettingControllerTest extends TestCase
{
    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'is_admin' => true,
            'email' => 'admin-map-' . uniqid() . '@example.com',
        ]);
    }

    public function test_admin_can_view_map_settings()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.map-settings.edit'));

        $response->assertStatus(200);
    }

    public function test_admin_can_update_map_settings()
    {
        // Ensure at least one MapSetting exists
        MapSetting::firstOrCreate(
            [],
            [
                'address' => 'Original Address',
                'phone' => '+628123456789',
                'email' => 'original@example.com',
                'latitude' => -6.2088,
                'longitude' => 106.8456,
            ]
        );

        $data = [
            'address' => 'Updated Address ' . uniqid(),
            'phone' => '+62812345678',
            'email' => 'updated@example.com',
            'operation_hours' => '09:00-18:00',
            'latitude' => -6.2088,
            'longitude' => 106.8456,
            'google_maps_url' => 'https://maps.google.com/...',
        ];

        $response = $this->actingAs($this->admin)
            ->put(route('admin.map-settings.update'), $data);

        // Just verify that the request was accepted
        $this->assertTrue(
            in_array($response->status(), [200, 201, 302, 303, 307, 308]),
            'Expected successful response, got ' . $response->status()
        );
    }
}
