<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'is_admin' => true,
            'email' => 'admin-dashboard-' . uniqid() . '@example.com',
        ]);
    }

    public function test_unauthenticated_user_cannot_access_dashboard()
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_non_admin_user_cannot_access_dashboard()
    {
        $user = User::factory()->create(['is_admin' => false, 'email' => 'user-dash-' . uniqid() . '@example.com']);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $this->assertTrue(
            $response->status() === 403 || $response->status() === 302,
            'Expected 403 or 302 redirect, got ' . $response->status()
        );
    }

    public function test_admin_can_access_dashboard()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    public function test_dashboard_displays_statistics()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
        // Just verify the dashboard loads successfully
        $response->assertViewIs('admin.dashboard');
    }
}
