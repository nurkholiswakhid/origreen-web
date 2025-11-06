@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center bg-fixed bg-cover bg-center" style="background-image: url('{{ $about->image_url }}');">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl">
            <h1 class="text-5xl font-bold text-white mb-6">{{ $about->title }}</h1>
            <div class="prose prose-lg text-white/90">
                <p class="text-xl">{{ $about->subtitle }}</p>
            </div>
        </div>
    </div>
</section>

<!-- About Content Section -->
<section class="py-20">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <div class="w-full h-96 rounded-3xl overflow-hidden shadow-xl">
                    @if($about->image_url)
                        <img src="{{ $about->image_url }}" alt="{{ $about->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center">
                            <i class="fas fa-tree text-9xl text-primary"></i>
                        </div>
                    @endif
                </div>
            </div>

            <div>
                <div class="prose prose-lg max-w-none">
                    {!! $about->description !!}
                </div>

                <div class="grid grid-cols-2 gap-6 mt-12">
                    <div class="text-center p-6 bg-white rounded-xl shadow-md">
                        @if(isset($about->stats_visitor['icon']) && isset($about->stats_visitor['color']))
                            <i class="{{ $about->stats_visitor['icon'] }} text-4xl mb-3" style="color: {{ $about->stats_visitor['color'] }}"></i>
                        @else
                            <i class="fas fa-users text-4xl text-primary mb-3"></i>
                        @endif
                        <h4 class="text-2xl font-bold text-gray-800">{{ $about->stats_visitor['value'] ?? '0' }}</h4>
                        <p class="text-gray-600">{{ $about->stats_visitor['title'] ?? 'Pengunjung' }}</p>
                    </div>
                    <div class="text-center p-6 bg-white rounded-xl shadow-md">
                        @if(isset($about->stats_rating['icon']) && isset($about->stats_rating['color']))
                            <i class="{{ $about->stats_rating['icon'] }} text-4xl mb-3" style="color: {{ $about->stats_rating['color'] }}"></i>
                        @else
                            <i class="fas fa-star text-4xl text-yellow-400 mb-3"></i>
                        @endif
                        <h4 class="text-2xl font-bold text-gray-800">{{ $about->stats_rating['value'] ?? '0' }}</h4>
                        <p class="text-gray-600">{{ $about->stats_rating['title'] ?? 'Rating' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact & Location Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Contact Information -->
            <div class="bg-white p-8 rounded-2xl shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-address-card text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">Informasi Kontak</h3>
                </div>
                <div class="space-y-6">
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt text-primary text-2xl mr-4 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Alamat</h4>
                            <p class="text-gray-600">{{ $mapSetting->address }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <i class="fas fa-phone text-primary text-2xl mr-4 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Telepon</h4>
                            <p class="text-gray-600">{{ $mapSetting->phone }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <i class="fas fa-envelope text-primary text-2xl mr-4 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Email</h4>
                            <p class="text-gray-600">{{ $mapSetting->email }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <i class="fas fa-clock text-primary text-2xl mr-4 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Jam Operasional</h4>
                            <p class="text-gray-600">{{ $mapSetting->operation_hours }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="bg-white p-8 rounded-2xl shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-map text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">Lokasi Kami</h3>
                </div>
                    <div class="rounded-xl overflow-hidden h-[400px] mb-4">
                    <iframe
                        src="{{ $mapSetting->map_embed_url }}"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <a href="{{ $mapSetting->google_maps_url }}" target="_blank"
                   class="w-full bg-primary text-white text-center py-3 rounded-full font-semibold hover:bg-secondary transition flex items-center justify-center">
                    <i class="fas fa-directions mr-2"></i>
                    Buka di Google Maps
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
