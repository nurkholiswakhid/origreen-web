@extends('layouts.app')

@section('content')


    <!-- banner -->
    <section id="home" class="relative min-h-[90vh] flex items-center text-white">
        <!-- Background image with overlay -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/90 to-secondary/90"></div>
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1565967511849-76a60a516170?auto=format&fit=crop&q=80'); filter: brightness(0.8);"></div>
        </div>

        <!-- Content -->
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">Selamat Datang di <span class="text-white/90">Origreen</span></h1>
                    <p class="text-xl mb-8 text-white/90">Nikmati keindahan alam Indonesia dengan berbagai wahana seru dan fasilitas lengkap untuk liburan keluarga yang tak terlupakan</p>
                    <div class="space-x-4">
                        <a href="#wahana" class="bg-white text-primary px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition inline-block shadow-lg hover:shadow-xl">Jelajahi Wahana</a>
                        <a href="#peta" class="border-2 border-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-primary transition inline-block backdrop-blur-sm">Lihat Lokasi</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll down indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
            <a href="#tentang" class="text-white/80 hover:text-white">
                <i class="fas fa-chevron-down text-3xl"></i>
            </a>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Tentang Origreen</h2>
                <div class="w-20 h-1 bg-primary mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="w-full h-96 bg-gradient-to-br from-primary/20 to-secondary/20 rounded-3xl flex items-center justify-center">
                        <i class="fas fa-tree text-9xl text-primary"></i>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-6">Wisata Alam Terbaik Indonesia</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Origreen adalah destinasi wisata alam yang menawarkan pengalaman tak terlupakan di tengah keindahan alam Indonesia. Dengan konsep eco-tourism, kami berkomitmen untuk melestarikan lingkungan sambil memberikan pengalaman wisata terbaik.
                    </p>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Dikelilingi oleh pemandangan hijau yang asri, udara segar pegunungan, dan berbagai wahana menarik, Origreen adalah tempat sempurna untuk berlibur bersama keluarga dan teman-teman.
                    </p>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center p-6 bg-white rounded-xl shadow-md">
                            <i class="fas fa-users text-4xl text-primary mb-3"></i>
                            <h4 class="text-2xl font-bold text-gray-800">50K+</h4>
                            <p class="text-gray-600">Pengunjung</p>
                        </div>
                        <div class="text-center p-6 bg-white rounded-xl shadow-md">
                            <i class="fas fa-award text-4xl text-primary mb-3"></i>
                            <h4 class="text-2xl font-bold text-gray-800">4.8/5</h4>
                            <p class="text-gray-600">Rating</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Wahana & Fasilitas Section -->
    <section id="wahana" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Wahana & Fasilitas</h2>
                <div class="w-20 h-1 bg-primary mx-auto mb-4"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Berbagai wahana seru dan fasilitas lengkap untuk pengalaman wisata yang sempurna</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Wahana 1 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
                    <div class="h-48 bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                        <i class="fas fa-hiking text-7xl text-white group-hover:scale-110 transition"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Trekking Alam</h3>
                        <p class="text-gray-600 mb-4">Jelajahi keindahan alam dengan jalur trekking yang menantang dan pemandangan spektakuler</p>
                        <div class="flex items-center text-primary">
                            <i class="fas fa-clock mr-2"></i>
                            <span>2-3 jam</span>
                        </div>
                    </div>
                </div>

                <!-- Wahana 2 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
                    <div class="h-48 bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                        <i class="fas fa-water text-7xl text-white group-hover:scale-110 transition"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Air Terjun</h3>
                        <p class="text-gray-600 mb-4">Nikmati kesegaran air terjun alami yang jernih di tengah hutan tropis</p>
                        <div class="flex items-center text-primary">
                            <i class="fas fa-walking mr-2"></i>
                            <span>30 menit</span>
                        </div>
                    </div>
                </div>

                <!-- Wahana 3 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
                    <div class="h-48 bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                        <i class="fas fa-campground text-7xl text-white group-hover:scale-110 transition"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Camping Ground</h3>
                        <p class="text-gray-600 mb-4">Area camping yang luas dengan fasilitas lengkap untuk pengalaman menginap di alam</p>
                        <div class="flex items-center text-primary">
                            <i class="fas fa-tent mr-2"></i>
                            <span>1-2 malam</span>
                        </div>
                    </div>
                </div>

                <!-- Fasilitas 1 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
                    <div class="h-48 bg-gradient-to-br from-secondary to-dark flex items-center justify-center">
                        <i class="fas fa-utensils text-7xl text-white group-hover:scale-110 transition"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Restoran</h3>
                        <p class="text-gray-600 mb-4">Berbagai pilihan kuliner dengan menu lokal dan internasional</p>
                        <div class="flex items-center text-primary">
                            <i class="fas fa-star mr-2"></i>
                            <span>Halal Certified</span>
                        </div>
                    </div>
                </div>

                <!-- Fasilitas 2 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
                    <div class="h-48 bg-gradient-to-br from-secondary to-dark flex items-center justify-center">
                        <i class="fas fa-parking text-7xl text-white group-hover:scale-110 transition"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Parkir Luas</h3>
                        <p class="text-gray-600 mb-4">Area parkir yang luas dan aman untuk kendaraan pribadi dan bus</p>
                        <div class="flex items-center text-primary">
                            <i class="fas fa-shield-alt mr-2"></i>
                            <span>24/7 Security</span>
                        </div>
                    </div>
                </div>

                <!-- Fasilitas 3 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
                    <div class="h-48 bg-gradient-to-br from-secondary to-dark flex items-center justify-center">
                        <i class="fas fa-wifi text-7xl text-white group-hover:scale-110 transition"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Free WiFi</h3>
                        <p class="text-gray-600 mb-4">Koneksi internet gratis di seluruh area wisata untuk berbagi momen</p>
                        <div class="flex items-center text-primary">
                            <i class="fas fa-signal mr-2"></i>
                            <span>High Speed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Section -->
    <section id="berita" class="py-20 bg-gray-50">
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

    <!-- Testimoni Section -->
    <section id="testimoni" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Apa Kata Mereka?</h2>
                <div class="w-20 h-1 bg-primary mx-auto mb-4"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Testimoni dari pengunjung yang telah merasakan pengalaman luar biasa di Origreen</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimoni 1 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white text-2xl font-bold mr-4">
                            AB
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Ahmad Budiman</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Tempat yang sangat indah dan menyenangkan untuk liburan keluarga. Anak-anak sangat senang dengan berbagai wahana yang tersedia. Highly recommended!"</p>
                </div>

                <!-- Testimoni 2 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-secondary rounded-full flex items-center justify-center text-white text-2xl font-bold mr-4">
                            SP
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Siti Permata</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Pemandangannya luar biasa! Udara segar dan fasilitasnya lengkap. Perfect untuk healing dan refreshing dari rutinitas sehari-hari."</p>
                </div>

                <!-- Testimoni 3 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-dark rounded-full flex items-center justify-center text-white text-2xl font-bold mr-4">
                            DP
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Doni Pratama</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Camping di sini benar-benar pengalaman yang tak terlupakan. Suasananya asri dan tenang. Akan kembali lagi pasti!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Peta Section -->
    <section id="peta" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Lokasi Kami</h2>
                <div class="w-20 h-1 bg-primary mx-auto mb-4"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Temukan lokasi Origreen dengan mudah dan rencanakan kunjungan Anda</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <div class="bg-white p-8 rounded-2xl shadow-lg">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Informasi Lokasi</h3>

                        <div class="space-y-4">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-primary text-2xl mr-4 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Alamat</h4>
                                    <p class="text-gray-600">Jl. Wisata Alam No. 123, Desa Hijau, Kec. Pegunungan, Kabupaten Indah, Indonesia</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <i class="fas fa-phone text-primary text-2xl mr-4 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Telepon</h4>
                                    <p class="text-gray-600">+62 812-3456-7890</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <i class="fas fa-envelope text-primary text-2xl mr-4 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Email</h4>
                                    <p class="text-gray-600">info@origreen.com</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <i class="fas fa-clock text-primary text-2xl mr-4 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Jam Operasional</h4>
                                    <p class="text-gray-600">Senin - Minggu: 08.00 - 17.00 WIB</p>
                                </div>
                            </div>
                        </div>

                        <a href="https://maps.google.com" target="_blank" class="mt-6 block w-full bg-primary text-white text-center py-3 rounded-full font-semibold hover:bg-secondary transition">
                            <i class="fas fa-directions mr-2"></i>Buka di Google Maps
                        </a>
                    </div>
                </div>

                <div>
                    <div class="bg-gradient-to-br from-primary/20 to-secondary/20 rounded-2xl h-96 flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-map-marked-alt text-8xl text-primary mb-4"></i>
                            <p class="text-gray-700 font-semibold">Peta Lokasi Interaktif</p>
                            <p class="text-gray-600 text-sm mt-2">Ganti dengan Google Maps iframe</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Pertanyaan yang Sering Diajukan</h2>
                <div class="w-20 h-1 bg-primary mx-auto mb-4"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Temukan jawaban untuk pertanyaan umum tentang Origreen</p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                <!-- FAQ Items using CSS-only accordion -->
                <style>
                    .faq-toggle:checked + .faq-content {
                        display: block;
                    }
                    .faq-toggle:checked + .faq-content .icon-down {
                        transform: rotate(180deg);
                    }
                </style>

                <!-- FAQ 1 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-xl overflow-hidden">
                    <input type="checkbox" id="faq-1" class="faq-toggle hidden">
                    <label for="faq-1" class="faq-content">
                        <div class="w-full text-left p-6 flex justify-between items-center hover:bg-primary/10 transition cursor-pointer">
                            <h3 class="font-semibold text-gray-800 text-lg">Berapa harga tiket masuk Origreen?</h3>
                            <i class="fas fa-chevron-down text-primary icon-down transition-transform"></i>
                        </div>
                        <div class="hidden px-6 pb-6">
                            <p class="text-gray-600">Harga tiket masuk Origreen adalah Rp 50.000 untuk weekday dan Rp 75.000 untuk weekend. Tersedia juga paket keluarga dengan harga spesial.</p>
                        </div>
                    </label>
                </div>

                <!-- FAQ 2 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-xl overflow-hidden">
                    <input type="checkbox" id="faq-2" class="faq-toggle hidden">
                    <label for="faq-2" class="faq-content">
                        <div class="w-full text-left p-6 flex justify-between items-center hover:bg-primary/10 transition cursor-pointer">
                            <h3 class="font-semibold text-gray-800 text-lg">Apakah bisa melakukan reservasi camping?</h3>
                            <i class="fas fa-chevron-down text-primary icon-down transition-transform"></i>
                        </div>
                        <div class="hidden px-6 pb-6">
                            <p class="text-gray-600">Ya, Anda bisa melakukan reservasi camping melalui website atau menghubungi customer service kami. Reservasi minimal dilakukan 3 hari sebelum kedatangan.</p>
                        </div>
                    </label>
                </div>

                <!-- FAQ 3 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-xl overflow-hidden">
                    <input type="checkbox" id="faq-3" class="faq-toggle hidden">
                    <label for="faq-3" class="faq-content">
                        <div class="w-full text-left p-6 flex justify-between items-center hover:bg-primary/10 transition cursor-pointer">
                            <h3 class="font-semibold text-gray-800 text-lg">Apakah tersedia pemandu wisata?</h3>
                            <i class="fas fa-chevron-down text-primary icon-down transition-transform"></i>
                        </div>
                        <div class="hidden px-6 pb-6">
                            <p class="text-gray-600">Tentu! Kami menyediakan pemandu wisata profesional yang berpengalaman. Layanan guide dapat dipesan saat pembelian tiket dengan biaya tambahan.</p>
                        </div>
                    </label>
                </div>

                <!-- FAQ 4 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-xl overflow-hidden">
                    <input type="checkbox" id="faq-4" class="faq-toggle hidden">
                    <label for="faq-4" class="faq-content">
                        <div class="w-full text-left p-6 flex justify-between items-center hover:bg-primary/10 transition cursor-pointer">
                            <h3 class="font-semibold text-gray-800 text-lg">Apakah aman untuk anak-anak?</h3>
                            <i class="fas fa-chevron-down text-primary icon-down transition-transform"></i>
                        </div>
                        <div class="hidden px-6 pb-6">
                            <p class="text-gray-600">Sangat aman! Semua wahana dan area wisata telah dilengkapi dengan standar keamanan yang ketat. Tim keamanan kami siaga 24/7 untuk menjaga kenyamanan pengunjung.</p>
                        </div>
                    </label>
                </div>

                <!-- FAQ 5 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-xl overflow-hidden">
                    <input type="checkbox" id="faq-5" class="faq-toggle hidden">
                    <label for="faq-5" class="faq-content">
                        <div class="w-full text-left p-6 flex justify-between items-center hover:bg-primary/10 transition cursor-pointer">
                            <h3 class="font-semibold text-gray-800 text-lg">Apakah ada paket rombongan?</h3>
                            <i class="fas fa-chevron-down text-primary icon-down transition-transform"></i>
                        </div>
                        <div class="hidden px-6 pb-6">
                            <p class="text-gray-600">Ya, tersedia paket khusus untuk rombongan minimal 20 orang dengan harga lebih ekonomis. Hubungi tim marketing kami untuk detail lebih lanjut.</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </section>

@endsection
