@extends('layouts.app')

@section('content')
        <!-- Wahana & Fasilitas Section content copied -->
        <section class="py-20 bg-white">
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
@endsection
