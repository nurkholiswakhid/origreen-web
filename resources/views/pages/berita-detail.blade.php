@extends('layouts.app')

@section('content')
<section class="py-20">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">{{ $news->title }}</h1>
            <div class="flex items-center text-gray-500 mb-8">
                <div class="flex items-center mr-6">
                    <i class="fas fa-calendar mr-2"></i>
                    <span>{{ $news->published_at->format('d F Y') }}</span>
                </div>
            </div>
        </div>

        @if($news->image_url)
        <div class="mb-12">
            <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full h-96 object-cover rounded-2xl">
        </div>
        @endif

        <div class="prose prose-lg max-w-none mb-12">
            {!! $news->content !!}
        </div>

        <hr class="my-12 border-gray-200">

        <div class="flex justify-between items-center">
            <a href="{{ route('berita') }}" class="inline-flex items-center text-primary hover:underline">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Daftar Berita
            </a>
        </div>
    </div>
</section>
@endsection
