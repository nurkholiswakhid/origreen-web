<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Ahmad Budiman',
                'occupation' => 'Pengusaha',
                'content' => 'Tempat yang sangat indah dan menyenangkan untuk liburan keluarga. Anak-anak sangat senang dengan berbagai wahana yang tersedia. Highly recommended!',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Siti Permata',
                'occupation' => 'Guru',
                'content' => 'Pemandangannya luar biasa! Udara segar dan fasilitasnya lengkap. Perfect untuk healing dan refreshing dari rutinitas sehari-hari.',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Doni Pratama',
                'occupation' => 'Photographer',
                'content' => 'Camping di sini benar-benar pengalaman yang tak terlupakan. Suasananya asri dan tenang. Akan kembali lagi pasti!',
                'rating' => 4.5,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
