<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run()
    {
        About::create([
            'title' => 'Tentang Origreen',
            'image_url' => 'https://images.unsplash.com/photo-1565967511849-76a60a516170?auto=format&fit=crop&q=80',
            'subtitle' => 'Wisata Alam Terbaik Indonesia',
            'description' => 'Origreen adalah destinasi wisata alam yang menawarkan pengalaman tak terlupakan di tengah keindahan alam Indonesia. Dengan konsep eco-tourism, kami berkomitmen untuk melestarikan lingkungan sambil memberikan pengalaman wisata terbaik.',
            'stats_visitor' => '50K+',
            'stats_rating' => '4.8/5',
        ]);
    }
}
