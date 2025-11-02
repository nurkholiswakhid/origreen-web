@extends('admin.layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Edit Berita</h1>
    <a href="{{ route('admin.news.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow-md">
    <div class="p-6">
        <form action="{{ route('admin.news.update', $news) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title', $news->title) }}"
                       class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('title') border-red-500 @enderror"
                       required>
                @error('title')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
                <textarea id="excerpt"
                          name="excerpt"
                          rows="3"
                          class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('excerpt') border-red-500 @enderror"
                          required>{{ old('excerpt', $news->excerpt) }}</textarea>
                @error('excerpt')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Konten</label>
                <textarea id="content"
                          name="content"
                          rows="6"
                          class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('content') border-red-500 @enderror"
                          required>{{ old('content', $news->content) }}</textarea>
                @error('content')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Icon (Font Awesome Class)</label>
                <input type="text"
                       id="icon"
                       name="icon"
                       value="{{ old('icon', $news->icon) }}"
                       class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('icon') border-red-500 @enderror"
                       placeholder="fas fa-newspaper"
                       required>
                @error('icon')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image_url" class="block text-sm font-medium text-gray-700 mb-1">URL Gambar</label>
                <input type="url"
                       id="image_url"
                       name="image_url"
                       value="{{ old('image_url', $news->image_url) }}"
                       class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('image_url') border-red-500 @enderror"
                       required>
                @error('image_url')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Publikasi</label>
                <input type="datetime-local"
                       id="published_at"
                       name="published_at"
                       value="{{ old('published_at', $news->published_at->format('Y-m-d\TH:i')) }}"
                       class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('published_at') border-red-500 @enderror"
                       required>
                @error('published_at')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition-colors">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
