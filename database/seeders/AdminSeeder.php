<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Origreen',
            'email' => 'admin@origreen.com',
            'is_admin' => true,
            'password' => bcrypt('password123'),
        ]);
    }
}
