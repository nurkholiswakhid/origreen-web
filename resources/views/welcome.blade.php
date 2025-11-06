@extends('layouts.app')

@section('content')


    <!-- banner -->
    <section id="home" class="relative min-h-[90vh] flex items-center text-white">
        <!-- Background image with overlay -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/90 to-secondary/90"></div>
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $banner->image_url }}'); filter: brightness(0.8);"></div>
        </div>

        <!-- Content -->
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">{{ $banner->title }}</h1>
                    <p class="text-xl mb-8 text-white/90">{{ $banner->description }}</p>
                    <div class="space-x-4">
                        <a href="{{ $banner->button1_url }}" class="bg-white text-primary px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition inline-block shadow-lg hover:shadow-xl">{{ $banner->button1_text }}</a>
                        <a href="{{ $banner->button2_url }}" class="border-2 border-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-primary transition inline-block backdrop-blur-sm">{{ $banner->button2_text }}</a>
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
                <h2 class="text-4xl font-bold text-gray-800 mb-4">{{ $about->title }}</h2>
                <div class="w-20 h-1 bg-primary mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="w-full h-96 rounded-3xl overflow-hidden">
                        <img src="{{ $about->image_url }}" alt="About Origreen" class="w-full h-full object-cover">
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-6">{{ $about->subtitle }}</h3>
                    <div class="prose prose-lg max-w-none text-gray-600 mb-6">
                        {!! $about->description !!}
                    </div>


                                            <div class="grid grid-cols-2 gap-6">
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

    <!-- Wahana & Fasilitas Section -->
    <section id="wahana" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Wahana & Fasilitas</h2>
                <div class="w-20 h-1 bg-primary mx-auto mb-4"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Berbagai wahana seru dan fasilitas lengkap untuk pengalaman wisata yang sempurna</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach($facilities->where('is_active', true)->where('type', 'wahana') as $facility)
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
                    <div class="h-48 bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                        <i class="{{ $facility->icon }} text-7xl text-white group-hover:scale-110 transition"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $facility->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ $facility->description }}</p>
                        <div class="flex items-center text-primary">
                            <i class="fas fa-clock mr-2"></i>
                            <span>{{ $facility->duration }}</span>
                        </div>
                    </div>
                </div>
                @endforeach

                @foreach($facilities->where('is_active', true)->where('type', 'fasilitas') as $facility)
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
                    <div class="h-48 bg-gradient-to-br from-secondary to-dark flex items-center justify-center">
                        <i class="{{ $facility->icon }} text-7xl text-white group-hover:scale-110 transition"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $facility->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ $facility->description }}</p>
                        <div class="flex items-center text-primary">
                            <i class="fas fa-shield-alt mr-2"></i>
                            <span>{{ $facility->duration }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
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
                @foreach($news as $item)
                <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                    <div class="h-48 relative overflow-hidden">
                        @if($item->image_url)
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="h-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                                <i class="fas fa-newspaper text-7xl text-white"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>{{ $item->published_at->format('d F Y') }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition">{{ $item->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ $item->excerpt }}</p>
                        <a href="{{ route('berita.show', $item->id) }}" class="text-primary font-semibold hover:underline">Baca Selengkapnya →</a>
                    </div>
                </article>
                @endforeach
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
                @forelse($testimonials as $testimonial)
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 flex-shrink-0">
                            @if($testimonial->avatar_url)
                                <img src="{{ $testimonial->avatar_url }}" alt="{{ $testimonial->name }}" class="w-16 h-16 rounded-full object-cover">
                            @else
                                <div class="w-16 h-16 bg-{{ ['primary', 'secondary', 'dark'][random_int(0, 2)] }} rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                    {{ Str::upper(substr($testimonial->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-800">{{ $testimonial->name }}</h4>
                            @if($testimonial->occupation)
                                <p class="text-sm text-gray-600">{{ $testimonial->occupation }}</p>
                            @endif
                            <div class="flex text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $testimonial->rating)
                                        <i class="fas fa-star"></i>
                                    @elseif($i - 0.5 <= $testimonial->rating)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"{{ $testimonial->content }}"</p>
                </div>
                @empty
                <div class="col-span-3 text-center text-gray-500">
                    <p>Belum ada testimoni.</p>
                </div>
                @endforelse
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

                        <a href="{{ $mapSetting->google_maps_url }}" target="_blank" class="mt-6 block w-full bg-primary text-white text-center py-3 rounded-full font-semibold hover:bg-secondary transition">
                            <i class="fas fa-directions mr-2"></i>Buka di Google Maps
                        </a>
                    </div>
                </div>

                <div>
                    <div class="rounded-2xl h-96 overflow-hidden shadow-lg">
                        <iframe
                            src="{{ str_replace('maps.google.com', 'www.google.com/maps/embed', $mapSetting->google_maps_url) }}"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
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
                    .faq-toggle:checked ~ .faq-answer {
                        display: block;
                    }
                    .faq-toggle:checked ~ .faq-question .icon-down {
                        transform: rotate(180deg);
                    }
                </style>

                @forelse($faqs as $faq)
                <!-- FAQ Item -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-xl overflow-hidden">
                    <input type="checkbox" id="faq-{{ $faq->id }}" class="faq-toggle hidden">
                    <label for="faq-{{ $faq->id }}" class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-primary/10 transition cursor-pointer">
                        <h3 class="font-semibold text-gray-800 text-lg">{{ $faq->question }}</h3>
                        <i class="fas fa-chevron-down text-primary icon-down transition-transform"></i>
                    </label>
                    <div class="faq-answer hidden px-6 pb-6">
                        <p class="text-gray-600">{{ $faq->answer }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center text-gray-500">
                    <p>Belum ada FAQ.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection
