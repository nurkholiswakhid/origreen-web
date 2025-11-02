<?php

namespace Database\Seeders;

use App\Models\MapSetting;
use Illuminate\Database\Seeder;

class MapSettingSeeder extends Seeder
{
    public function run(): void
    {
        MapSetting::updateOrCreate(
            ['id' => 1],
            [
                'address' => 'Jl. Wisata Alam No. 123, Desa Hijau, Kec. Pegunungan, Kabupaten Indah, Indonesia',
                'phone' => '+62 812-3456-7890',
                'email' => 'info@origreen.com',
                'operation_hours' => 'Senin - Minggu: 08.00 - 17.00 WIB',
                'google_maps_url' => 'https://maps.google.com',
            ]
        );
    }
}
