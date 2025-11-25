<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_user_can_be_created()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john-' . time() . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        $this->assertNotNull($user->id);
        $this->assertEquals('John Doe', $user->name);
    }

    public function test_user_can_be_updated()
    {
        $user = User::factory()->create();
        
        $user->update([
            'name' => 'Jane Doe',
            'email' => 'jane-' . time() . '@example.com',
        ]);

        $this->assertEquals('Jane Doe', $user->name);
    }

    public function test_user_can_be_deleted()
    {
        $user = User::factory()->create();
        $userId = $user->id;

        $user->delete();

        $this->assertNull(User::find($userId));
    }

    public function test_user_has_is_admin_attribute()
    {
        $user = User::factory()->create(['is_admin' => false]);
        
        $this->assertFalse($user->is_admin);
    }

    public function test_user_password_is_hashed()
    {
        $password = 'password123';
        $user = User::create([
            'name' => 'Test User',
            'email' => 'hashed-' . time() . '@example.com',
            'password' => bcrypt($password),
        ]);

        $this->assertTrue(\Illuminate\Support\Facades\Hash::check($password, $user->password));
    }

    public function test_user_can_authenticate()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('password123', $user->password));
    }

    public function test_user_password_is_hidden_on_serialization()
    {
        $user = User::factory()->create();
        
        $hidden = $user->getHidden();
        $this->assertContains('password', $hidden);
        $this->assertContains('remember_token', $hidden);
    }

    public function test_user_email_verified_at_is_cast_to_datetime()
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->assertNotNull($user->email_verified_at);
    }

    public function test_user_fillable_attributes()
    {
        $attributes = [
            'name' => 'Test User',
            'email' => 'fillable-' . time() . '@example.com',
            'password' => bcrypt('password'),
        ];

        $user = User::create($attributes);

        $this->assertEquals('Test User', $user->name);
    }
}
