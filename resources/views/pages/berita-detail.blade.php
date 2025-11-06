@extends('layouts.app')

@section('meta')
<meta property="og:title" content="{{ $news->title }}" />
<meta property="og:description" content="{{ $news->excerpt }}" />
@if($news->image_url)
<meta property="og:image" content="{{ $news->image_url }}" />
@endif
@endsection

@section('content')
<section class="py-20">
    <div class="container mx-auto px-4">
        <!-- Breadcrumbs -->
        <div class="mb-8">
            <div class="flex items-center text-sm text-gray-500">
                <a href="{{ route('berita') }}" class="hover:text-primary">Berita</a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <span class="text-gray-700">{{ $news->title }}</span>
            </div>
        </div>

        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">{{ $news->title }}</h1>
            <div class="flex items-center text-gray-500 mb-8">
                <div class="flex items-center mr-6">
                    <i class="fas fa-calendar mr-2"></i>
                    <span>{{ $news->published_at->format('d F Y') }}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-clock mr-2"></i>
                    <span>{{ $news->published_at->format('H:i') }} WIB</span>
                </div>
            </div>
        </div>

        @if($news->image_url)
        <div class="mb-12">
            <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full h-96 object-cover rounded-2xl">
        </div>
        @endif

        <!-- Excerpt/Summary -->
        <div class="bg-gray-50 p-6 rounded-xl mb-12 text-gray-600 italic border-l-4 border-primary">
            {{ $news->excerpt }}
        </div>

        <!-- Main Content -->
        <div class="prose prose-lg max-w-none mb-12">
            {!! $news->content !!}
        </div>

        <hr class="my-12 border-gray-200">

        <!-- Navigation & Share -->
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <a href="{{ route('berita') }}" class="inline-flex items-center text-primary hover:underline">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Daftar Berita
            </a>

            <!-- Share Buttons -->
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Bagikan:</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                   target="_blank"
                   class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}" 
                   target="_blank"
                   class="w-8 h-8 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . request()->url()) }}" 
                   target="_blank"
                   class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </div>
        
        <!-- Related News -->
        @if($relatedNews && $relatedNews->count() > 0)
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-800 mb-8">Berita Terkait</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($relatedNews as $item)
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
                        <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition">
                            <a href="{{ route('berita.show', $item) }}">{{ $item->title }}</a>
                        </h3>
                        <p class="text-gray-600 mb-4">{{ $item->excerpt }}</p>
                        <a href="{{ route('berita.show', $item) }}" class="text-primary font-semibold hover:underline">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
