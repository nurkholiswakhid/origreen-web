<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    public function test_user_has_api_tokens_trait()
    {
        $user = User::factory()->create();
        
        // Check if method from HasApiTokens exists
        $this->assertTrue(method_exists($user, 'tokens'));
    }

    public function test_user_has_factory()
    {
        $user = User::factory()->make();
        
        $this->assertNotNull($user->email);
        $this->assertNotNull($user->name);
    }

    public function test_user_casting()
    {
        $user = User::factory()->create();
        $casts = $user->getCasts();
        
        $this->assertArrayHasKey('email_verified_at', $casts);
    }

    public function test_user_is_authenticatable()
    {
        $user = User::factory()->create();
        
        // Check if user implements Authenticatable
        $this->assertInstanceOf(\Illuminate\Contracts\Auth\Authenticatable::class, $user);
    }

    public function test_user_can_authenticate_with_email()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('password', $user->password));
    }
}
