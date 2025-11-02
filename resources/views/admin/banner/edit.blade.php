@extends('admin.layouts.app')

@section('title', 'Edit Banner')

@push('scripts')
<script src="https://cdn.tiny.cloud/1/guezyx1f1bttzpfenpe72isge9aqgdon3yh1xik229g89vs2/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
    tinymce.init({
        selector: '#description',
        height: 400,
        menubar: true,
        plugins: [
            // Core editing features
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists',
            'media', 'searchreplace', 'table', 'visualblocks', 'wordcount', 'image',
            // Premium features
            'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed',
            'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste',
            'advtable', 'advcode', 'advtemplate', 'ai', 'mentions', 'tinycomments',
            'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography',
            'inlinecss', 'markdown', 'importword', 'exportword', 'exportpdf'
        ],
        images_upload_url: '{{ route("admin.upload-image") }}',
        images_upload_credentials: true,
        automatic_uploads: true,
        images_reuse_filename: true,
        images_upload_handler: function (blobInfo, success, failure, progress) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '{{ route("admin.upload-image") }}');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

            xhr.upload.onprogress = function (e) {
                progress(e.loaded / e.total * 100);
            };

            xhr.onload = function() {
                var json;
                if (xhr.status === 403) {
                    failure('HTTP Error: ' + xhr.status, { remove: true });
                    return;
                }
                if (xhr.status < 200 || xhr.status >= 300) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);
                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };

            xhr.onerror = function () {
                failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };

            formData = new FormData();
            formData.append('image', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        },
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | ' +
                'link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | ' +
                'align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        file_picker_types: 'image',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Admin',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }',
        branding: false,
        promotion: false,
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('AI Assistant not configured')),
    });
</script>
@endpush

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Edit Banner</h1>
    <a href="{{ url('/') }}" target="_blank" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
        <i class="fas fa-eye mr-2"></i>Lihat Website
    </a>
</div>

<div class="bg-white rounded-lg shadow-md">
    <div class="p-6">
        <form action="{{ route('admin.banner.update') }}" method="POST" enctype="multipart/form-data">
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
