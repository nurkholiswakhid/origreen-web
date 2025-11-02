<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run()
    {
        $facilities = [
            [
                'name' => 'Trekking Alam',
                'description' => 'Jelajahi keindahan alam dengan jalur trekking yang menantang dan pemandangan spektakuler',
                'icon' => 'fas fa-hiking',
                'duration' => '2-3 jam',
                'type' => 'wahana',
                'order' => 1,
            ],
            [
                'name' => 'Air Terjun',
                'description' => 'Nikmati kesegaran air terjun alami yang jernih di tengah hutan tropis',
                'icon' => 'fas fa-water',
                'duration' => '30 menit',
                'type' => 'wahana',
                'order' => 2,
            ],
            [
                'name' => 'Camping Ground',
                'description' => 'Area camping yang luas dengan fasilitas lengkap untuk pengalaman menginap di alam',
                'icon' => 'fas fa-campground',
                'duration' => '1-2 malam',
                'type' => 'wahana',
                'order' => 3,
            ],
            [
                'name' => 'Restoran',
                'description' => 'Berbagai pilihan kuliner dengan menu lokal dan internasional',
                'icon' => 'fas fa-utensils',
                'duration' => 'Halal Certified',
                'type' => 'fasilitas',
                'order' => 4,
            ],
            [
                'name' => 'Parkir Luas',
                'description' => 'Area parkir yang luas dan aman untuk kendaraan pribadi dan bus',
                'icon' => 'fas fa-parking',
                'duration' => '24/7 Security',
                'type' => 'fasilitas',
                'order' => 5,
            ],
            [
                'name' => 'Free WiFi',
                'description' => 'Koneksi internet gratis di seluruh area wisata untuk berbagi momen',
                'icon' => 'fas fa-wifi',
                'duration' => 'High Speed',
                'type' => 'fasilitas',
                'order' => 6,
            ],
        ];

        foreach ($facilities as $facility) {
            Facility::create($facility);
        }
    }
}
