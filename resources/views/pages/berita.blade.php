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
            @forelse($news as $item)
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                <div class="h-48 relative overflow-hidden">
                    @if($item->image_url)
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="h-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                            <i class="fas fa-newspaper text-7xl text-white"></i>
                        </div>
                    @endif
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4">
                        <div class="flex items-center text-sm text-white">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>{{ $item->published_at->isoFormat('D MMMM Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition">
                        <a href="{{ route('berita.show', $item) }}">{{ $item->title }}</a>
                    </h3>
                    <p class="text-gray-600 mb-4">{{ $item->excerpt }}</p>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('berita.show', $item) }}" class="text-primary font-semibold hover:underline">
                            Baca Selengkapnya →
                        </a>
                        <span class="text-sm text-gray-500">
                            <i class="far fa-clock mr-1"></i>
                            {{ $item->published_at->format('H:i') }} WIB
                        </span>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-3 text-center py-12">
                <div class="bg-gray-100 rounded-xl p-8 max-w-lg mx-auto">
                    <i class="fas fa-newspaper text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Berita</h3>
                    <p class="text-gray-500">Belum ada berita atau event yang dipublikasikan saat ini. Silakan kunjungi kembali nanti.</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($news->hasPages())
        <div class="mt-12">
            {{ $news->links() }}
        </div>
        @endif
    </div>
</section>
@endsection

    <!-- toggleMenu() provided by partial -->
</body>
</html>
