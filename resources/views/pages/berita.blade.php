@extends('layouts.app')

@section('content')
<!-- Berita content -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Berita & Event Terbaru</h2>
            <div class="w-20 h-1 bg-primary mx-auto mb-4"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">Update terkini tentang event dan kegiatan di Origreen</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Berita 1 -->
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                <div class="h-48 bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                    <i class="fas fa-calendar-check text-7xl text-white"></i>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <i class="fas fa-calendar mr-2"></i>
                        <span>25 Oktober 2025</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition">Festival Alam Origreen 2025</h3>
                    <p class="text-gray-600 mb-4">Bergabunglah dengan festival alam tahunan kami dengan berbagai kegiatan menarik dan kompetisi seru.</p>
                    <a href="#" class="text-primary font-semibold hover:underline">Baca Selengkapnya →</a>
                </div>
            </article>

            <!-- Berita 2 -->
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                <div class="h-48 bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                    <i class="fas fa-seedling text-7xl text-white"></i>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <i class="fas fa-calendar mr-2"></i>
                        <span>15 Oktober 2025</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition">Program Penanaman 1000 Pohon</h3>
                    <p class="text-gray-600 mb-4">Mari bersama-sama melestarikan lingkungan dengan program penanaman pohon massal di area Origreen.</p>
                    <a href="#" class="text-primary font-semibold hover:underline">Baca Selengkapnya →</a>
                </div>
            </article>

            <!-- Berita 3 -->
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                <div class="h-48 bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                    <i class="fas fa-gift text-7xl text-white"></i>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <i class="fas fa-calendar mr-2"></i>
                        <span>1 November 2025</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition">Promo Akhir Tahun Special</h3>
                    <p class="text-gray-600 mb-4">Dapatkan diskon hingga 30% untuk tiket masuk dan paket wisata keluarga di bulan November.</p>
                    <a href="#" class="text-primary font-semibold hover:underline">Baca Selengkapnya →</a>
                </div>
            </article>
        </div>
    </div>
</section>
@endsection

    <!-- toggleMenu() provided by partial -->
</body>
</html>
