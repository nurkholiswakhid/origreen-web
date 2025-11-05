@extends('admin.layouts.app')

@section('title', 'Edit Berita')

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Edit Berita</h1>
    <a href="{{ route('admin.news.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="p-8">
        <form action="{{ route('admin.news.update', $news) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Berita</label>
                        <input type="text"
                               id="title"
                               name="title"
                               value="{{ old('title', $news->title) }}"
                               class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-50 transition-all duration-300 @error('title') border-red-500 @enderror"
                               placeholder="Masukkan judul berita"
                               required>
                        @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="excerpt" class="block text-sm font-semibold text-gray-700 mb-2">Ringkasan</label>
                        <textarea id="excerpt"
                                  name="excerpt"
                                  rows="3"
                                  class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-50 transition-all duration-300 @error('excerpt') border-red-500 @enderror"
                                  placeholder="Tulis ringkasan berita disini..."
                                  required>{{ old('excerpt', $news->excerpt) }}</textarea>
                        @error('excerpt')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="image_url" class="block text-sm font-semibold text-gray-700">Gambar Berita</label>
                        <input type="url"
                               id="image_url"
                               name="image_url"
                               value="{{ old('image_url', $news->image_url) }}"
                               class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-50 transition-all duration-300 @error('image_url') border-red-500 @enderror"
                               placeholder="https://example.com/image.jpg"
                               oninput="previewImage(this.value)"
                               required>
                        @error('image_url')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <div id="image-preview" class="mt-2 hidden">
                            <img src="" alt="Preview" class="max-w-full h-40 rounded-lg object-cover">
                        </div>
                    </div>

                    <div>
                        <label for="published_at" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Publikasi</label>
                        <input type="datetime-local"
                               id="published_at"
                               name="published_at"
                               value="{{ old('published_at', $news->published_at->format('Y-m-d\TH:i')) }}"
                               class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-50 transition-all duration-300 @error('published_at') border-red-500 @enderror"
                               required>
                        @error('published_at')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Konten Berita</label>
                    <div class="border-2 border-gray-300 rounded-lg @error('content') border-red-500 @enderror">
                        <div id="editor" class="h-96">{{ old('content', $news->content) }}</div>
                    </div>
                    <textarea id="content" name="content" class="hidden">{{ old('content', $news->content) }}</textarea>
                    @error('content')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-8">
                <button type="button" onclick="window.history.back()" class="px-6 py-2.5 rounded-lg border-2 border-gray-300 text-gray-700 hover:bg-gray-50 transition-all duration-300">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-primary text-white hover:bg-primary-dark transition-all duration-300 flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
    // Initialize Quill editor
    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Tulis konten berita disini...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    // Update hidden form field before submit
    document.querySelector('form').onsubmit = function() {
        document.querySelector('#content').value = quill.root.innerHTML;
    };

    // Image preview function
    function previewImage(url) {
        const preview = document.getElementById('image-preview');
        const img = preview.querySelector('img');

        if (url && url.trim() !== '') {
            img.src = url;
            img.onerror = function() {
                preview.classList.add('hidden');
            };
            img.onload = function() {
                preview.classList.remove('hidden');
            };
        } else {
            preview.classList.add('hidden');
        }
    }

    // Initialize image preview if URL exists
    window.onload = function() {
        const imageUrl = document.getElementById('image_url').value;
        if (imageUrl) {
            previewImage(imageUrl);
        }
    };
</script>
@endpush
@endsection
