<?php

namespace Database\Seeders;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run()
    {
        $news = [
            [
                'title' => 'Festival Alam Origreen 2025',
                'excerpt' => 'Bergabunglah dengan festival alam tahunan kami dengan berbagai kegiatan menarik dan kompetisi seru.',
                'content' => 'Festival Alam Origreen 2025 akan diselenggarakan pada tanggal 25 Oktober 2025. Event tahunan ini menghadirkan berbagai kegiatan menarik seperti lomba fotografi alam, workshop berkebun, kompetisi hiking, dan masih banyak lagi. Ayo bergabung dan rasakan keseruan bersama kami!',
                'published_at' => Carbon::create(2025, 10, 25),
            ],
            [
                'title' => 'Program Penanaman 1000 Pohon',
                'excerpt' => 'Mari bersama-sama melestarikan lingkungan dengan program penanaman pohon massal di area Origreen.',
                'content' => 'Dalam rangka mendukung program penghijauan dan pelestarian lingkungan, Origreen mengadakan program penanaman 1000 pohon yang akan dilaksanakan pada tanggal 15 Oktober 2025. Program ini terbuka untuk umum dan akan melibatkan berbagai komunitas pecinta lingkungan.',
                'published_at' => Carbon::create(2025, 10, 15),
            ],
            [
                'title' => 'Promo Akhir Tahun Special',
                'excerpt' => 'Dapatkan diskon hingga 30% untuk tiket masuk dan paket wisata keluarga di bulan November.',
                'content' => 'Menjelang akhir tahun, Origreen memberikan penawaran spesial berupa diskon hingga 30% untuk tiket masuk dan paket wisata keluarga. Promo ini berlaku sepanjang bulan November 2025. Jangan lewatkan kesempatan liburan hemat bersama keluarga!',
                'published_at' => Carbon::create(2025, 11, 1),
            ],
        ];

        foreach ($news as $item) {
            $newsItem = new News();
            $newsItem->fill($item);
            $newsItem->slug = Str::slug($item['title']);
            $newsItem->save();
        }
    }
}
