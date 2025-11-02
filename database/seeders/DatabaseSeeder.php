<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BannerSeeder::class,
            AboutSeeder::class,
            FacilitySeeder::class,
            NewsSeeder::class,
            TestimonialSeeder::class,
            MapSettingSeeder::class,
            FaqSeeder::class,
        ]);

        $adminData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => true,
            'password' => bcrypt('password'),
        ];

        $admin = \App\Models\User::where('email', $adminData['email'])->first();
        if ($admin) {
            $admin->update($adminData);
        } else {
            \App\Models\User::create($adminData);
        }
    }
}
