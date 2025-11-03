@extends('admin.layouts.app')

@section('title', 'Edit Tentang')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Tentang Section</h1>
        <p class="text-gray-600">Kelola informasi tentang perusahaan Anda</p>
    </div>
    <a href="{{ url('/') }}" target="_blank" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-all duration-300 flex items-center shadow-lg hover:shadow-xl">
        <i class="fas fa-eye mr-2"></i>Lihat Website
    </a>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="p-8 border-b border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-1">Informasi Utama</h2>
        <p class="text-gray-500 text-sm">Lengkapi detail informasi tentang perusahaan Anda</p>
    </div>
    <div class="p-8">
        <form action="{{ route('admin.about.update') }}" method="POST">

        <form action="{{ route('admin.about.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-1">
                    <label class="block text-gray-700 font-semibold" for="title">
                        Judul Utama
                    </label>
                    <input type="text" name="title" id="title"
                        value="{{ old('title', $about->title) }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200"
                        placeholder="Masukkan judul utama">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label class="block text-gray-700 font-semibold" for="image_url">
                        URL Gambar
                    </label>
                    <input type="text" name="image_url" id="image_url"
                        value="{{ old('image_url', $about->image_url) }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200"
                        placeholder="https://source.unsplash.com/800x600?nature">
                    <p class="text-gray-500 text-sm mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Masukkan URL gambar atau gunakan layanan seperti Unsplash
                    </p>
                    @error('image_url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-1 mb-6">
                <label class="block text-gray-700 font-semibold" for="subtitle">
                    Sub Judul
                </label>
                <input type="text" name="subtitle" id="subtitle"
                    value="{{ old('subtitle', $about->subtitle) }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200"
                    placeholder="Masukkan sub judul">
                @error('subtitle')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-6 mb-6">
                <div class="space-y-1">
                    <label class="block text-gray-700 font-semibold" for="description1">
                        Deskripsi Paragraf 1
                        <span class="text-gray-400 font-normal">(Utama)</span>
                    </label>
                    <textarea name="description1" id="description1" rows="4"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200"
                        placeholder="Masukkan deskripsi utama">{{ old('description1', $about->description1) }}</textarea>
                    @error('description1')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label class="block text-gray-700 font-semibold" for="description2">
                        Deskripsi Paragraf 2
                        <span class="text-gray-400 font-normal">(Tambahan)</span>
                    </label>
                    <textarea name="description2" id="description2" rows="4"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200"
                        placeholder="Masukkan deskripsi tambahan">{{ old('description2', $about->description2) }}</textarea>
                    @error('description2')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="border-t border-gray-100 pt-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Statistik Website</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="block text-gray-700 font-semibold" for="stats_visitor">
                            <i class="fas fa-users mr-2 text-green-500"></i>Total Pengunjung
                        </label>
                        <input type="text" name="stats_visitor" id="stats_visitor"
                            value="{{ old('stats_visitor', $about->stats_visitor) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200"
                            placeholder="Contoh: 1000">
                        @error('stats_visitor')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-gray-700 font-semibold" for="stats_rating">
                            <i class="fas fa-star mr-2 text-yellow-400"></i>Rating
                        </label>
                        <input type="text" name="stats_rating" id="stats_rating"
                            value="{{ old('stats_rating', $about->stats_rating) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200"
                            placeholder="Contoh: 4.5">
                        @error('stats_rating')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end mt-8">
                <a href="javascript:history.back()" class="mr-4 px-6 py-3 rounded-lg text-gray-600 hover:text-gray-800 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
