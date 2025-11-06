<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socialMedia = [
            [
                'platform' => 'Facebook',
                'url' => 'https://facebook.com/origreen',
                'icon' => 'fab fa-facebook',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'platform' => 'Instagram',
                'url' => 'https://instagram.com/origreen',
                'icon' => 'fab fa-instagram',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'platform' => 'Twitter',
                'url' => 'https://twitter.com/origreen',
                'icon' => 'fab fa-twitter',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'platform' => 'YouTube',
                'url' => 'https://youtube.com/origreen',
                'icon' => 'fab fa-youtube',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($socialMedia as $social) {
            SocialMedia::create($social);
        }
    }
}
