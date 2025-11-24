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

                <!-- Wahana Section -->
                <div class="mb-16">
                    <h3 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Wahana</h3>
                    <div class="grid md:grid-cols-3 gap-8">
                        @forelse($wahana as $item)
                        <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
                            <div class="h-48 bg-gradient-to-br from-primary to-secondary flex items-center justify-center overflow-hidden">
                                @if($item->display_type === 'icon')
                                    <i class="{{ $item->main_icon ?? $item->icon }} text-7xl text-white group-hover:scale-110 transition"></i>
                                @elseif($item->display_type === 'image' && $item->image_url)
                                    <img src="{{ asset('storage/' . str_replace('/storage/', '', $item->image_url)) }}"
                                         alt="{{ $item->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-300"
                                         onerror="this.onerror=null; this.src='{{ asset('images/default-facility.png') }}'; console.log('Error loading image: {{ $item->image_url }}');">
                                @else
                                    <i class="fas fa-image text-7xl text-white group-hover:scale-110 transition"></i>
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $item->name }}</h3>
                                <p class="text-gray-600 mb-4">{{ $item->description }}</p>
                                <div class="flex items-center text-primary">
                                    <i class="{{ $item->icon ?? 'fas fa-clock' }} mr-2"></i>
                                    <span>{{ $item->duration }}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-3 text-center py-12">
                            <div class="bg-gray-100 rounded-xl p-8 max-w-lg mx-auto">
                                <i class="fas fa-hiking text-6xl text-gray-400 mb-4"></i>
                                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Wahana</h3>
                                <p class="text-gray-500">Wahana akan segera ditambahkan.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Fasilitas Section -->
                <div>
                    <h3 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Fasilitas</h3>
                    <div class="grid md:grid-cols-3 gap-8">
                        @forelse($fasilitas as $item)
                        <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
                            <div class="h-48 bg-gradient-to-br from-secondary to-dark flex items-center justify-center overflow-hidden">
                                @if($item->display_type === 'icon')
                                    <i class="{{ $item->main_icon ?? $item->icon }} text-7xl text-white group-hover:scale-110 transition"></i>
                                @elseif($item->display_type === 'image' && $item->image_url)
                                    <img src="{{ asset('storage/' . str_replace('/storage/', '', $item->image_url)) }}"
                                         alt="{{ $item->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-300"
                                         onerror="this.onerror=null; this.src='{{ asset('images/default-facility.png') }}'; console.log('Error loading image: {{ $item->image_url }}');">
                                @else
                                    <i class="fas fa-image text-7xl text-white group-hover:scale-110 transition"></i>
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $item->name }}</h3>
                                <p class="text-gray-600 mb-4">{{ $item->description }}</p>
                                <div class="flex items-center text-primary">
                                    <i class="{{ $item->icon ?? 'fas fa-check' }} mr-2"></i>
                                    <span>{{ $item->duration }}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-3 text-center py-12">
                            <div class="bg-gray-100 rounded-xl p-8 max-w-lg mx-auto">
                                <i class="fas fa-cog text-6xl text-gray-400 mb-4"></i>
                                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Fasilitas</h3>
                                <p class="text-gray-500">Fasilitas akan segera ditambahkan.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
