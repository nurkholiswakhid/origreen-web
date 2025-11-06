@extends('admin.layouts.app')

@section('title', 'Edit Tentang')

@push('styles')
    <!-- FontAwesome Icon Picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fontawesome-iconpicker@3.2.0/dist/css/fontawesome-iconpicker.min.css">
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- Color Picker -->
    <style>
        .color-picker-wrapper {
            position: relative;
            width: 100%;
        }
        .color-picker-input {
            width: 100%;
            padding: 0.5rem;
            padding-left: 2.5rem;
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            cursor: pointer;
        }
        .color-picker-input:focus {
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
        }
        .color-preview {
            position: absolute;
            left: 0.5rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 0.25rem;
            border: 2px solid #fff;
            box-shadow: 0 0 0 1px #e5e7eb;
        }
        .color-picker-popup {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1060;
            margin-top: 0.5rem;
            padding: 1rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid #e5e7eb;
            width: 240px;
            display: none;
        }
        .color-picker-popup.show {
            display: block;
        }
        .preset-colors {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        .preset-color {
            width: 100%;
            padding-top: 100%;
            border-radius: 0.25rem;
            border: 2px solid #fff;
            box-shadow: 0 0 0 1px #e5e7eb;
            cursor: pointer;
            position: relative;
        }
        .preset-color:hover {
            transform: scale(1.1);
        }
        .preset-color.selected::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-shadow: 0 0 2px rgba(0,0,0,0.5);
        }
        .custom-color {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
        }
        .custom-color label {
            display: block;
            font-size: 0.875rem;
            color: #4b5563;
            margin-bottom: 0.5rem;
        }
        .custom-color input {
            width: 100%;
            padding: 0.5rem;
            border-radius: 0.25rem;
            border: 1px solid #e5e7eb;
        }
        .iconpicker-popover {
            z-index: 1050;
        }
        .iconpicker .iconpicker-item {
            width: 36px;
            height: 36px;
            line-height: 36px;
        }
        .iconpicker-search {
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
        }
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
            background: white;
        }
        .ql-editor {
            min-height: 200px;
        }
    </style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Edit Tentang Section</h1>
            <p class="text-sm sm:text-base text-gray-600">Kelola informasi tentang perusahaan Anda</p>
        </div>
        <a href="{{ url('/') }}" target="_blank"
            class="bg-green-600 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg hover:bg-green-700 transition-all duration-300 flex items-center shadow-lg hover:shadow-xl text-sm sm:text-base whitespace-nowrap">
            <i class="fas fa-eye mr-2"></i>Lihat Website
        </a>
    </div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="p-4 sm:p-6 lg:p-8 border-b border-gray-100">
        <h2 class="text-lg sm:text-xl font-semibold text-gray-700 mb-1">Informasi Utama</h2>
        <p class="text-gray-500 text-sm">Lengkapi detail informasi tentang perusahaan Anda</p>
    </div>
    <div class="p-4 sm:p-6 lg:p-8">
        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-3 gap-4 sm:gap-6">
                <!-- Right Column - Content -->
                <div class="md:col-span-2 space-y-4 sm:space-y-6">
                    <!-- Title Section -->
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2" for="title">
                                    <i class="fas fa-heading mr-2 text-green-500"></i>Judul Utama
                                </label>
                                <input type="text" name="title" id="title"
                                    value="{{ old('title', $about->title) }}"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 bg-white"
                                    placeholder="Masukkan judul utama">
                                @error('title')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2" for="subtitle">
                                    <i class="fas fa-align-left mr-2 text-green-500"></i>Sub Judul
                                </label>
                                <input type="text" name="subtitle" id="subtitle"
                                    value="{{ old('subtitle', $about->subtitle) }}"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 bg-white"
                                    placeholder="Masukkan sub judul">
                                @error('subtitle')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <label class="block text-gray-700 font-semibold mb-3" for="description">
                            <i class="fas fa-paragraph mr-2 text-green-500"></i>Deskripsi
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="description-editor">
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                                <div id="editor" class="prose max-w-none"></div>
                            </div>
                            <input type="hidden" name="description" id="description" value="{{ old('description', $about->description) }}">
                            <div class="mt-2 flex items-start space-x-2 text-gray-600 text-sm">
                                <i class="fas fa-info-circle mt-0.5"></i>
                                <span>
                                    Gunakan toolbar di atas untuk memformat teks.
                                    <br>
                                    Tip: Gunakan Ctrl+B untuk bold, Ctrl+I untuk italic, dan Ctrl+U untuk underline.
                                </span>
                            </div>
                        </div>
                        @error('description')
                            <p class="text-red-500 text-sm mt-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row items-center justify-end gap-3 sm:gap-4 mt-6 sm:mt-8 pt-6 border-t border-gray-100">
                        <a href="javascript:history.back()"
                            class="w-full sm:w-auto px-4 sm:px-6 py-2.5 rounded-lg text-gray-600 hover:text-gray-800 hover:bg-gray-100 transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            <span>Kembali</span>
                        </a>
                        <button type="submit"
                            class="w-full sm:w-auto bg-green-600 text-white px-4 sm:px-8 py-2.5 rounded-lg hover:bg-green-700 transition-all duration-200 font-semibold shadow-sm hover:shadow-md flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </div>

                <!-- Left Column - Image Upload -->
                <div class="md:col-span-1 space-y-4">
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <label class="block text-gray-700 font-semibold mb-3" for="image">
                            <i class="fas fa-image mr-2 text-green-500"></i>Foto Sampul
                        </label>

                        <!-- Image Preview -->
                        <div class="relative group mb-3">
                            <img id="imagePreview"
                                src="{{ old('image_url', $about->image_url) }}"
                                alt="Preview"
                                onerror="this.src='https://via.placeholder.com/800x600?text=Pilih+Gambar'"
                                class="w-full aspect-video object-cover rounded-lg border border-gray-200 shadow-sm">
                            <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-lg flex items-center justify-center">
                                <span class="text-white text-sm bg-black bg-opacity-50 px-3 py-2 rounded-lg">
                                    <i class="fas fa-camera mr-2"></i>Ganti Gambar
                                </span>
                            </div>
                        </div>

                        <!-- Hidden inputs -->
                        <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                        <input type="hidden" name="image_url" id="image_url" value="{{ old('image_url', $about->image_url) }}">

                        <!-- Upload button -->
                        <button type="button"
                            onclick="document.getElementById('image').click()"
                            class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center gap-2 shadow-sm">
                            <i class="fas fa-cloud-upload-alt text-green-500"></i>
                            <span>Upload Gambar</span>
                        </button>

                        <p class="text-gray-500 text-sm mt-3">
                            <i class="fas fa-info-circle mr-1"></i>
                            Format: JPG, PNG, GIF (Maks. 2MB)
                        </p>

                        @error('image')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stats Section -->
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <h3 class="text-gray-700 font-semibold mb-4">
                            <i class="fas fa-chart-line mr-2 text-green-500"></i>Statistik
                        </h3>
                        <div class="space-y-6">
                            <!-- Visitor Stats -->
                            <div class="space-y-3 pb-4 border-b border-gray-200">
                                <h4 class="font-medium text-gray-700">Statistik 1</h4>

                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-gray-600 text-sm mb-1.5" for="stats_visitor_icon">Icon</label>
                                        <div class="relative">
                                            <input type="text"
                                                class="icon-picker w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 bg-white cursor-pointer"
                                                value="{{ old('stats_visitor.icon', $about->stats_visitor['icon'] ?? 'fas fa-users') }}"
                                                readonly>
                                            <input type="hidden"
                                                name="stats_visitor[icon]"
                                                value="{{ old('stats_visitor.icon', $about->stats_visitor['icon'] ?? 'fas fa-users') }}">
                                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-gray-500">
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-gray-600 text-sm mb-1.5" for="stats_visitor_color">Warna</label>
                                        <div class="color-picker-wrapper">
                                            <input type="text" readonly
                                                class="color-picker-input"
                                                id="stats_visitor_color_display"
                                                value="{{ old('stats_visitor.color', $about->stats_visitor['color'] ?? '#22c55e') }}"
                                                data-target="stats_visitor_color">
                                            <div class="color-preview" id="stats_visitor_color_preview" style="background-color: {{ old('stats_visitor.color', $about->stats_visitor['color'] ?? '#22c55e') }}"></div>
                                            <div class="color-picker-popup" id="stats_visitor_color_popup">
                                                <div class="preset-colors">
                                                    <div class="preset-color" style="background-color: #22c55e" data-color="#22c55e" title="Hijau"></div>
                                                    <div class="preset-color" style="background-color: #3b82f6" data-color="#3b82f6" title="Biru"></div>
                                                    <div class="preset-color" style="background-color: #ef4444" data-color="#ef4444" title="Merah"></div>
                                                    <div class="preset-color" style="background-color: #eab308" data-color="#eab308" title="Kuning"></div>
                                                    <div class="preset-color" style="background-color: #8b5cf6" data-color="#8b5cf6" title="Ungu"></div>
                                                    <div class="preset-color" style="background-color: #ec4899" data-color="#ec4899" title="Pink"></div>
                                                    <div class="preset-color" style="background-color: #f97316" data-color="#f97316" title="Oranye"></div>
                                                    <div class="preset-color" style="background-color: #14b8a6" data-color="#14b8a6" title="Teal"></div>
                                                    <div class="preset-color" style="background-color: #06b6d4" data-color="#06b6d4" title="Cyan"></div>
                                                    <div class="preset-color" style="background-color: #0ea5e9" data-color="#0ea5e9" title="Sky"></div>
                                                    <div class="preset-color" style="background-color: #6366f1" data-color="#6366f1" title="Indigo"></div>
                                                    <div class="preset-color" style="background-color: #a855f7" data-color="#a855f7" title="Purple"></div>
                                                </div>
                                                <div class="custom-color">
                                                    <label>Warna Kustom</label>
                                                    <input type="color" class="custom-color-input" data-target="stats_visitor_color">
                                                </div>
                                            </div>
                                            <input type="hidden" name="stats_visitor[color]" id="stats_visitor_color"
                                                value="{{ old('stats_visitor.color', $about->stats_visitor['color'] ?? '#22c55e') }}">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-gray-600 text-sm mb-1.5" for="stats_visitor_title">Judul</label>
                                    <input type="text" name="stats_visitor[title]" id="stats_visitor_title"
                                        value="{{ old('stats_visitor.title', $about->stats_visitor['title'] ?? '') }}"
                                        class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 bg-white"
                                        placeholder="Contoh: Total Pengunjung">
                                </div>

                                <div>
                                    <label class="block text-gray-600 text-sm mb-1.5" for="stats_visitor_value">Nilai</label>
                                    <input type="text" name="stats_visitor[value]" id="stats_visitor_value"
                                        value="{{ old('stats_visitor.value', $about->stats_visitor['value'] ?? '') }}"
                                        class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 bg-white"
                                        placeholder="Contoh: 1000">
                                </div>
                                @error('stats_visitor')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Rating Stats -->
                            <div class="space-y-3">
                                <h4 class="font-medium text-gray-700">Statistik 2</h4>

                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-gray-600 text-sm mb-1.5" for="stats_rating_icon">Icon</label>
                                        <div class="relative">
                                            <input type="text"
                                                class="icon-picker w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 bg-white cursor-pointer"
                                                value="{{ old('stats_rating.icon', $about->stats_rating['icon'] ?? 'fas fa-star') }}"
                                                readonly>
                                            <input type="hidden"
                                                name="stats_rating[icon]"
                                                value="{{ old('stats_rating.icon', $about->stats_rating['icon'] ?? 'fas fa-star') }}">
                                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-gray-500">
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-gray-600 text-sm mb-1.5" for="stats_rating_color">Warna</label>
                                        <div class="color-picker-wrapper">
                                            <input type="text" readonly
                                                class="color-picker-input"
                                                id="stats_rating_color_display"
                                                value="{{ old('stats_rating.color', $about->stats_rating['color'] ?? '#eab308') }}"
                                                data-target="stats_rating_color">
                                            <div class="color-preview" id="stats_rating_color_preview" style="background-color: {{ old('stats_rating.color', $about->stats_rating['color'] ?? '#eab308') }}"></div>
                                            <div class="color-picker-popup" id="stats_rating_color_popup">
                                                <div class="preset-colors">
                                                    <div class="preset-color" style="background-color: #eab308" data-color="#eab308" title="Kuning"></div>
                                                    <div class="preset-color" style="background-color: #22c55e" data-color="#22c55e" title="Hijau"></div>
                                                    <div class="preset-color" style="background-color: #3b82f6" data-color="#3b82f6" title="Biru"></div>
                                                    <div class="preset-color" style="background-color: #ef4444" data-color="#ef4444" title="Merah"></div>
                                                    <div class="preset-color" style="background-color: #8b5cf6" data-color="#8b5cf6" title="Ungu"></div>
                                                    <div class="preset-color" style="background-color: #ec4899" data-color="#ec4899" title="Pink"></div>
                                                    <div class="preset-color" style="background-color: #f97316" data-color="#f97316" title="Oranye"></div>
                                                    <div class="preset-color" style="background-color: #14b8a6" data-color="#14b8a6" title="Teal"></div>
                                                    <div class="preset-color" style="background-color: #06b6d4" data-color="#06b6d4" title="Cyan"></div>
                                                    <div class="preset-color" style="background-color: #0ea5e9" data-color="#0ea5e9" title="Sky"></div>
                                                    <div class="preset-color" style="background-color: #6366f1" data-color="#6366f1" title="Indigo"></div>
                                                    <div class="preset-color" style="background-color: #a855f7" data-color="#a855f7" title="Purple"></div>
                                                </div>
                                                <div class="custom-color">
                                                    <label>Warna Kustom</label>
                                                    <input type="color" class="custom-color-input" data-target="stats_rating_color">
                                                </div>
                                            </div>
                                            <input type="hidden" name="stats_rating[color]" id="stats_rating_color"
                                                value="{{ old('stats_rating.color', $about->stats_rating['color'] ?? '#eab308') }}">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-gray-600 text-sm mb-1.5" for="stats_rating_title">Judul</label>
                                    <input type="text" name="stats_rating[title]" id="stats_rating_title"
                                        value="{{ old('stats_rating.title', $about->stats_rating['title'] ?? '') }}"
                                        class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 bg-white"
                                        placeholder="Contoh: Rating">
                                </div>

                                <div>
                                    <label class="block text-gray-600 text-sm mb-1.5" for="stats_rating_value">Nilai</label>
                                    <input type="text" name="stats_rating[value]" id="stats_rating_value"
                                        value="{{ old('stats_rating.value', $about->stats_rating['value'] ?? '') }}"
                                        class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 bg-white"
                                        placeholder="Contoh: 4.5">
                                </div>
                                @error('stats_rating')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

@push('scripts')
    <!-- jQuery (needed for Icon Picker) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <!-- FontAwesome Icon Picker -->
    <script src="https://cdn.jsdelivr.net/npm/fontawesome-iconpicker@3.2.0/dist/js/fontawesome-iconpicker.min.js"></script>
    <script>
        // Initialize Color Pickers
        function initColorPickers() {
            const colorPickers = document.querySelectorAll('.color-picker-input');

            colorPickers.forEach(picker => {
                // Show color picker popup on click
                picker.addEventListener('click', function(e) {
                    const popup = this.nextElementSibling.nextElementSibling;
                    // Close other popups
                    document.querySelectorAll('.color-picker-popup').forEach(p => {
                        if (p !== popup) p.classList.remove('show');
                    });
                    popup.classList.toggle('show');
                });

                // Handle preset color selection
                const popup = picker.nextElementSibling.nextElementSibling;
                const presetColors = popup.querySelectorAll('.preset-color');
                const targetInput = document.getElementById(picker.dataset.target);
                const preview = picker.nextElementSibling;

                presetColors.forEach(preset => {
                    preset.addEventListener('click', function() {
                        const color = this.dataset.color;
                        picker.value = color;
                        targetInput.value = color;
                        preview.style.backgroundColor = color;
                        presetColors.forEach(p => p.classList.remove('selected'));
                        this.classList.add('selected');
                        popup.classList.remove('show');
                    });

                    // Mark selected preset
                    if (preset.dataset.color === picker.value) {
                        preset.classList.add('selected');
                    }
                });

                // Handle custom color input
                const customInput = popup.querySelector('.custom-color-input');
                customInput.addEventListener('input', function() {
                    const color = this.value;
                    picker.value = color;
                    targetInput.value = color;
                    preview.style.backgroundColor = color;
                    presetColors.forEach(p => p.classList.remove('selected'));
                });
            });

            // Close popups when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.color-picker-wrapper')) {
                    document.querySelectorAll('.color-picker-popup').forEach(popup => {
                        popup.classList.remove('show');
                    });
                }
            });
        }

        // Initialize Quill with enhanced configuration
        let quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Masukkan deskripsi perusahaan...',
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
                ]
            }
        });

        // Set initial content from the hidden input
        const descriptionInput = document.getElementById('description');
        const initialContent = descriptionInput.value;

        // Set the content in the editor
        if (initialContent) {
            quill.root.innerHTML = initialContent;
        }

        // Update description when editor content changes
        quill.on('text-change', function() {
            descriptionInput.value = quill.root.innerHTML.trim();
        });

        // Initialize Icon Pickers with custom settings
        $('.icon-picker').iconpicker({
            title: 'Pilih Icon',
            selected: true,
            defaultValue: 'fas fa-users',
            placement: 'bottom',
            collision: 'none',
            animation: true,
            hideOnSelect: true,
            templates: {
                popover: '<div class="iconpicker-popover popover shadow-lg"><div class="arrow"></div>' +
                        '<div class="popover-title bg-gray-50 rounded-t-lg"></div><div class="popover-content"></div></div>',
                footer: '<div class="popover-footer p-2 bg-gray-50 rounded-b-lg text-right"></div>',
                buttons: '<button class="iconpicker-btn text-sm px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Pilih</button>',
                search: '<input type="search" class="iconpicker-search mb-2" placeholder="Cari icon...">'
            }
        }).on('iconpickerSelected', function(e) {
            // Update the associated input field when an icon is selected
            const iconInput = $(this).siblings('input[type="hidden"]');
            iconInput.val(e.iconpickerValue);
        });

        // Initialize Color Pickers
        initColorPickers();

        // Make the preview image clickable
        document.getElementById('imagePreview').addEventListener('click', function() {
            document.getElementById('image').click();
        });

        // Handle form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            // Get the description content from Quill
            const description = quill.root.innerHTML.trim();

            // Validate description
            if (!description || description === '<p><br></p>') {
                e.preventDefault();
                alert('Deskripsi tidak boleh kosong');
                return false;
            }

            // Update the hidden input with the current content
            document.getElementById('description').value = description;

            // Log the form data being submitted
            console.log('Form data - description:', description);
            return true;
        });

        // Update hidden input whenever editor content changes
        quill.on('text-change', function() {
            const description = quill.root.innerHTML.trim();
            const hiddenInput = document.getElementById('description');
            if (hiddenInput) {
                hiddenInput.value = description;
                console.log('Editor content updated:', description);
            }
        });

        // Image preview function
        function previewImage(input) {
            if (input.files && input.files[0]) {
                // Validate file size (2MB max)
                if (input.files[0].size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush

@endsection
