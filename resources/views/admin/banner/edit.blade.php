@extends('admin.layouts.app')

@section('title', 'Edit Banner')

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        initQuillEditor();
    });

    function initQuillEditor() {
        console.log('Initializing Quill Editor');
        var quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Tulis deskripsi banner di sini...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    ['link'],
                    ['clean']
                ],
                clipboard: {
                    matchVisual: false
                }
            }
        });

        // Set initial content if exists
        const initialContent = document.querySelector('#description').value;
        if (initialContent) {
            quill.root.innerHTML = initialContent;
        }

        // Update hidden form field when content changes
        quill.on('text-change', function() {
            document.querySelector('#description').value = quill.root.innerHTML;
        });

        // Update hidden form field when content changes
        quill.on('text-change', function() {
            document.querySelector('#description').value = quill.root.innerHTML;
        });

        // Update hidden form field before submit
        document.querySelector('form').onsubmit = function() {
            document.querySelector('#description').value = quill.root.innerHTML;
        };
    }
</script>

<style>
    .ql-toolbar.ql-snow {
        border-color: #e5e7eb;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
        background: #f9fafb;
    }
    .ql-container.ql-snow {
        border-color: #e5e7eb;
        border-bottom-left-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
        min-height: 200px;
    }
    .ql-editor {
        min-height: 200px;
        font-size: 1rem;
        line-height: 1.5;
    }
    .ql-editor p {
        margin-bottom: 1rem;
    }
</style>
@endpush


@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Edit Banner</h1>
</div>

<div class="bg-white rounded-lg shadow-md">
    <div class="p-6">
        <form action="{{ route('admin.banner.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Judul Banner -->
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

            <!-- Deskripsi dengan Quill -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Deskripsi
                    <span class="text-red-500">*</span>
                </label>
                <div class="bg-white rounded-lg shadow-sm">
                    <div id="editor" class="bg-white prose max-w-none">{!! old('description', $banner->description) !!}</div>
                </div>
                <textarea name="description" id="description" class="hidden">{!! old('description', $banner->description) !!}</textarea>
                <div class="mt-2 flex items-start space-x-2 text-gray-600 text-sm">
                    <i class="fas fa-info-circle mt-0.5"></i>
                    <span>
                        Gunakan toolbar di atas untuk memformat teks. Teks akan otomatis tersimpan saat Anda mengetik.
                        <br>
                        Tip: Gunakan Ctrl+B untuk bold, Ctrl+I untuk italic, dan Ctrl+U untuk underline.
                    </span>
                </div>
                @error('description')
                    <p class="text-red-500 text-sm mt-2">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <!-- Upload Gambar -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    Gambar Banner
                </label>
                <div class="flex items-center space-x-4">
                    <div class="flex-1">
                        <input type="file"
                               id="image"
                               accept="image/*"
                               class="hidden"
                               onchange="handleImageUpload(this)">
                        <input type="hidden"
                               name="image_url"
                               id="image_url"
                               value="{{ old('image_url', $banner->image_url) }}">
                        <div class="flex items-center justify-center px-4 py-6 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-primary"
                             onclick="document.getElementById('image').click()">
                            <div class="text-center">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-gray-600">Klik untuk upload gambar</p>
                                <p class="text-gray-400 text-sm">PNG, JPG, GIF hingga 2MB</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-48">
                        <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden bg-gray-100">
                            <img src="{{ $banner->image_url }}"
                                 alt="Preview"
                                 id="preview-image"
                                 class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
                @error('image_url')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <script>
            function handleImageUpload(input) {
                if (input.files && input.files[0]) {
                    const formData = new FormData();
                    formData.append('image', input.files[0]);
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route("admin.upload-image") }}', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('image_url').value = data.location;
                        document.getElementById('preview-image').src = data.location;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Gagal mengupload gambar. Silakan coba lagi.');
                    });
                }
            }
            </script>

            <!-- Tombol -->
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

            <!-- Tombol Submit -->
            <div class="flex items-center justify-end">
                <button type="submit"
                        class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
