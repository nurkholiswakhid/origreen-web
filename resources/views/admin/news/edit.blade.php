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
                        <label class="block text-sm font-semibold text-gray-700">Gambar Berita</label>
                        <div class="relative">
                            <!-- Hidden file input -->
                            <input type="file"
                                   id="image"
                                   name="image"
                                   accept="image/*"
                                   class="hidden"
                                   onchange="handleImageUpload(this)">

                            <!-- Hidden image_url input -->
                            <input type="hidden"
                                   id="image_url"
                                   name="image_url"
                                   value="{{ old('image_url', $news->image_url) }}">

                            <!-- Upload Area -->
                            <div class="group cursor-pointer relative" onclick="document.getElementById('image').click()">
                                <!-- Preview Container -->
                                <div id="image-preview" class="hidden">
                                    <div class="relative">
                                        <img src="" alt="Preview" class="w-full h-48 rounded-lg object-cover">
                                        <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                                            <span class="text-white text-sm">
                                                <i class="fas fa-camera mr-2"></i>Ganti Gambar
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Upload Placeholder -->
                                <div id="upload-placeholder" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-primary transition-colors duration-300">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                    <div class="text-sm text-gray-600">
                                        <p class="font-semibold">Klik untuk upload gambar</p>
                                        <p class="text-gray-500 text-xs mt-1">atau drag and drop</p>
                                        <p class="text-gray-400 text-xs mt-2">PNG, JPG, GIF (Maks. 2MB)</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Loading Indicator -->
                            <div id="loading-indicator" class="hidden absolute inset-0 bg-white bg-opacity-90 rounded-lg flex items-center justify-center">
                                <div class="animate-spin rounded-full h-8 w-8 border-4 border-primary border-t-transparent"></div>
                            </div>
                        </div>
                        @error('image_url')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
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

    // Handle file upload
    function handleImageUpload(input) {
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('upload-placeholder');
        const loadingIndicator = document.getElementById('loading-indicator');
        const img = preview.querySelector('img');

        if (input.files && input.files[0]) {
            // Size validation (2MB)
            if (input.files[0].size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 2MB');
                input.value = '';
                return;
            }

            // Show loading indicator
            loadingIndicator.classList.remove('hidden');
            preview.classList.add('hidden');
            placeholder.classList.add('hidden');

            const formData = new FormData();
            formData.append('image', input.files[0]);
            formData.append('_token', '{{ csrf_token() }}');

            // Upload to server
            fetch('{{ route("admin.upload-image") }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Update hidden input and preview
                document.getElementById('image_url').value = data.location;
                img.src = data.location;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal mengupload gambar. Silakan coba lagi.');
                placeholder.classList.remove('hidden');
            })
            .finally(() => {
                loadingIndicator.classList.add('hidden');
            });
        }
    }

    // Handle drag and drop
    function setupDragAndDrop() {
        const dropZone = document.getElementById('upload-placeholder');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropZone.classList.add('border-primary', 'bg-primary', 'bg-opacity-5');
        }

        function unhighlight(e) {
            dropZone.classList.remove('border-primary', 'bg-primary', 'bg-opacity-5');
        }

        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length) {
                const input = document.getElementById('image');
                input.files = files;
                handleImageUpload(input);
            }
        }
    }

    // Initialize drag and drop
    setupDragAndDrop();

    // Initialize preview if URL exists
    window.addEventListener('load', function() {
        const imageUrl = document.getElementById('image_url').value;
        if (imageUrl) {
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('upload-placeholder');
            const img = preview.querySelector('img');

            img.src = imageUrl;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
    });
</script>
@endpush
@endsection
