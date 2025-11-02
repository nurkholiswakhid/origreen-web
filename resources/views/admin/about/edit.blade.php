@extends('admin.layouts.app')

@section('title', 'Edit Tentang')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Edit Tentang Section</h1>
    <a href="{{ url('/') }}" target="_blank" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
        <i class="fas fa-eye mr-2"></i>Lihat Website
    </a>
</div>

<div class="bg-white rounded-lg shadow-md">
    <div class="p-6">
        <form action="{{ route('admin.about.update') }}" method="POST">

        <form action="{{ route('admin.about.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    Judul Utama
                </label>
                <input type="text" name="title" id="title"
                    value="{{ old('title', $about->title) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('title')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image_url">
                    URL Gambar
                </label>
                <input type="text" name="image_url" id="image_url"
                    value="{{ old('image_url', $about->image_url) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p class="text-gray-500 text-xs mt-1">Masukkan URL gambar atau gunakan layanan seperti Unsplash (contoh: https://source.unsplash.com/800x600?nature,forest)</p>
                @error('image_url')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="subtitle">
                    Sub Judul
                </label>
                <input type="text" name="subtitle" id="subtitle"
                    value="{{ old('subtitle', $about->subtitle) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('subtitle')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description1">
                    Deskripsi Paragraf 1
                </label>
                <textarea name="description1" id="description1" rows="4"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description1', $about->description1) }}</textarea>
                @error('description1')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description2">
                    Deskripsi Paragraf 2
                </label>
                <textarea name="description2" id="description2" rows="4"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description2', $about->description2) }}</textarea>
                @error('description2')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="stats_visitor">
                        Total Pengunjung
                    </label>
                    <input type="text" name="stats_visitor" id="stats_visitor"
                        value="{{ old('stats_visitor', $about->stats_visitor) }}"
                        class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('stats_visitor') border-red-500 @enderror">
                    @error('stats_visitor')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="stats_rating">
                        Rating
                    </label>
                    <input type="text" name="stats_rating" id="stats_rating"
                        value="{{ old('stats_rating', $about->stats_rating) }}"
                        class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('stats_rating') border-red-500 @enderror">
                    @error('stats_rating')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-primary text-white font-bold py-2 px-4 rounded hover:bg-secondary focus:outline-none focus:shadow-outline">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
