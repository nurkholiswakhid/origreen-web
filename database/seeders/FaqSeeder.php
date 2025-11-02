<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Berapa harga tiket masuk Origreen?',
                'answer' => 'Harga tiket masuk Origreen adalah Rp 50.000 untuk weekday dan Rp 75.000 untuk weekend. Tersedia juga paket keluarga dengan harga spesial.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah bisa melakukan reservasi camping?',
                'answer' => 'Ya, Anda bisa melakukan reservasi camping melalui website atau menghubungi customer service kami. Reservasi minimal dilakukan 3 hari sebelum kedatangan.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah tersedia pemandu wisata?',
                'answer' => 'Tentu! Kami menyediakan pemandu wisata profesional yang berpengalaman. Layanan guide dapat dipesan saat pembelian tiket dengan biaya tambahan.',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah aman untuk anak-anak?',
                'answer' => 'Sangat aman! Semua wahana dan area wisata telah dilengkapi dengan standar keamanan yang ketat. Tim keamanan kami siaga 24/7 untuk menjaga kenyamanan pengunjung.',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah ada paket rombongan?',
                'answer' => 'Ya, tersedia paket khusus untuk rombongan minimal 20 orang dengan harga lebih ekonomis. Hubungi tim marketing kami untuk detail lebih lanjut.',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
