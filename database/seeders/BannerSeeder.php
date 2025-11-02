<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Seed the banner data.
     *
     * This seeder creates the initial banner content for the homepage.
     * The banner includes:
     * - Title and description
     * - Background image URL
     * - Call-to-action buttons with their respective URLs
     */
    public function run()
    {
        Banner::create([
            'title' => 'Selamat Datang di Origreen',
            'description' => 'Nikmati keindahan alam Indonesia dengan berbagai wahana seru dan fasilitas lengkap untuk liburan keluarga yang tak terlupakan',
            'image_url' => 'https://images.unsplash.com/photo-1565967511849-76a60a516170?auto=format&fit=crop&q=80',
            'button1_text' => 'Jelajahi Wahana',
            'button1_url' => '#wahana',
            'button2_text' => 'Lihat Lokasi',
            'button2_url' => '#peta',
        ]);
    }
}
