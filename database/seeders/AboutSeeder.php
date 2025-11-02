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
            'description1' => 'Origreen adalah destinasi wisata alam yang menawarkan pengalaman tak terlupakan di tengah keindahan alam Indonesia. Dengan konsep eco-tourism, kami berkomitmen untuk melestarikan lingkungan sambil memberikan pengalaman wisata terbaik.',
            'description2' => 'Dikelilingi oleh pemandangan hijau yang asri, udara segar pegunungan, dan berbagai wahana menarik, Origreen adalah tempat sempurna untuk berlibur bersama keluarga dan teman-teman.',
            'stats_visitor' => '50K+',
            'stats_rating' => '4.8/5',
        ]);
    }
}
