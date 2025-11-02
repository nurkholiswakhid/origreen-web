@extends('admin.layouts.app')

@section('title', 'Edit Banner')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Edit Banner</h1>
    <a href="{{ url('/') }}" target="_blank" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
        <i class="fas fa-eye mr-2"></i>Lihat Website
    </a>
</div>

<div class="bg-white rounded-lg shadow-md">
    <div class="p-6">
        <form action="{{ route('admin.banner.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    Judul Banner
                </label>
                <input type="text" name="title" id="title"
                    value="{{ old('title', $banner->title) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('title')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Deskripsi
                </label>
                <textarea name="description" id="description" rows="4"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description', $banner->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image_url">
                    URL Gambar
                </label>
                <input type="text" name="image_url" id="image_url"
                    value="{{ old('image_url', $banner->image_url) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('image_url')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
                <div class="mt-2">
                    <img src="{{ $banner->image_url }}" alt="Preview" class="max-h-40 rounded">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="button1_text">
                        Teks Tombol 1
                    </label>
                    <input type="text" name="button1_text" id="button1_text"
                        value="{{ old('button1_text', $banner->button1_text) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="button1_url">
                        URL Tombol 1
                    </label>
                    <input type="text" name="button1_url" id="button1_url"
                        value="{{ old('button1_url', $banner->button1_url) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="button2_text">
                        Teks Tombol 2
                    </label>
                    <input type="text" name="button2_text" id="button2_text"
                        value="{{ old('button2_text', $banner->button2_text) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="button2_url">
                        URL Tombol 2
                    </label>
                    <input type="text" name="button2_url" id="button2_url"
                        value="{{ old('button2_url', $banner->button2_url) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit"
                        class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
