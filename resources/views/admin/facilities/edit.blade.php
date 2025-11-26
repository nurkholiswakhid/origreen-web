@extends('admin.layouts.app')

@section('title', 'Edit Wahana/Fasilitas')

@push('styles')
    <!-- FontAwesome Icon Picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fontawesome-iconpicker@3.2.0/dist/css/fontawesome-iconpicker.min.css">
    <style>
        /* --- Form Wrapper Style --- */
        .image-preview-wrapper {
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            background: #f9fafb;
            border-radius: 0.75rem;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }

        .image-preview-wrapper:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(37, 99, 235, 0.08);
        }

        .image-preview-wrapper img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: inherit;
        }

        .image-preview-placeholder {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            font-size: 2rem;
            transition: all 0.3s ease;
        }

        .image-preview-placeholder i {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            opacity: 0.7;
        }

        .image-preview-wrapper:hover .image-preview-placeholder {
            color: #3b82f6;
            transform: scale(1.05);
            opacity: 0.9;
        }

        .image-preview-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .image-preview-wrapper:hover .image-preview-overlay {
            opacity: 1;
        }

        /* --- Icon Picker Style --- */
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
    </style>
@endpush

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Edit Wahana/Fasilitas</h1>
        <p class="text-sm text-gray-600 mt-1">Ubah informasi wahana atau fasilitas yang sudah ada</p>
    </div>
    <a href="{{ route('admin.facilities.index') }}"
        class="bg-white border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition-all duration-200 flex items-center group shadow-sm">
        <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>Kembali
    </a>
</div>

<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="border-b border-gray-100 bg-gradient-to-r from-primary/10 to-indigo-50 px-6 py-4 flex items-center text-gray-700">
        <i class="fas fa-edit text-primary mr-2"></i>
        <span class="font-semibold">Form Edit Data Wahana/Fasilitas</span>
    </div>

    <div class="p-6">
        <form action="{{ route('admin.facilities.update', $facility) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Pilihan Tampilan -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 mb-6 border border-blue-100">
                <label class="block text-sm font-medium text-gray-700 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-images text-primary mr-2"></i>
                        <span>Pilih Tampilan Utama</span>
                        <span class="text-red-500 ml-1">*</span>
                    </div>
                    <span class="text-gray-500 text-xs block mt-1">Pilih salah satu untuk tampilan utama fasilitas/wahana</span>
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Foto -->
                    <label class="block p-4 bg-white border-2 rounded-xl cursor-pointer hover:border-primary/80 hover:shadow-md transition-all group">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 transition">
                                    <i class="fas fa-camera text-primary text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-grow">
                                <div class="flex items-center">
                                    <input type="radio" name="display_type" value="image"
                                        class="text-primary focus:ring-primary mr-2"
                                        {{ old('display_type', $facility->display_type) === 'image' ? 'checked' : '' }}>
                                    <span class="text-sm font-medium text-gray-900">Tampilkan dengan Foto</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Upload foto untuk tampilan yang lebih menarik</p>
                            </div>
                        </div>
                    </label>

                    <!-- Icon -->
                    <label class="block p-4 bg-white border-2 rounded-xl cursor-pointer hover:border-primary/80 hover:shadow-md transition-all group">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 transition">
                                    <i class="fas fa-icons text-primary text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-grow">
                                <div class="flex items-center">
                                    <input type="radio" name="display_type" value="icon"
                                        class="text-primary focus:ring-primary mr-2"
                                        {{ old('display_type', $facility->display_type) === 'icon' ? 'checked' : '' }}>
                                    <span class="text-sm font-medium text-gray-900">Tampilkan dengan Icon</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Pilih icon yang mewakili fasilitas/wahana ini</p>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Input Nama dan Deskripsi -->
            <div class="grid grid-cols-1 gap-6 bg-gray-50 p-6 rounded-xl mb-6 border border-gray-100">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="name">
                        Nama Wahana/Fasilitas <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-tag"></i>
                        </span>
                        <input type="text" name="name" id="name" value="{{ old('name', $facility->name) }}"
                            class="pl-10 w-full rounded-xl border border-gray-300 bg-white px-4 py-2 text-gray-700 placeholder-gray-400 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary/50 hover:border-primary/70 transition-all duration-200 @error('name') border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Masukkan nama wahana atau fasilitas">
                    </div>
                    @error('name')
                    <p class="mt-1 text-sm text-red-500 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i> {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="description">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <textarea name="description" id="description" rows="3"
                            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2 text-gray-700 placeholder-gray-400 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary/50 hover:border-primary/70 transition-all duration-200 @error('description') border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Jelaskan detail tentang wahana atau fasilitas ini">{{ old('description', $facility->description) }}</textarea>
                        <div class="absolute right-2 bottom-2 text-gray-400" data-tooltip="Isi deskripsi">
                            <i class="fas fa-edit"></i>
                        </div>
                    </div>
                    @error('description')
                    <p class="mt-1 text-sm text-red-500 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i> {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

            <!-- Upload Gambar dan Icon -->
            <div class="space-y-6">
                <!-- Image Upload Section -->
                <div class="image-section bg-blue-50 p-4 rounded-xl border border-blue-100"
                    style="display: {{ old('display_type', $facility->display_type) === 'image' ? 'block' : 'none' }}">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Upload Foto Fasilitas/Wahana
                    </label>
                    <div class="image-preview-wrapper mb-3" onclick="document.getElementById('image').click()">
                        <img id="imagePreview"
                             src="{{ $facility->image_url ? Storage::url($facility->image_url) : '' }}"
                             alt=""
                             style="display: {{ $facility->image_url ? 'block' : 'none' }}">
                        <div class="image-preview-placeholder" style="display: {{ $facility->image_url ? 'none' : 'block' }}">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span class="text-sm">Klik untuk pilih gambar</span>
                        </div>
                        <div class="image-preview-overlay">
                            <span class="text-white text-sm bg-black bg-opacity-50 px-3 py-2 rounded">
                                <i class="fas fa-camera mr-2"></i>Pilih Gambar
                            </span>
                        </div>
                    </div>
                    <input type="file" name="image" id="image" accept="image/*" class="hidden"
                        onchange="previewImage(this)">
                    <p class="text-gray-500 text-xs text-center">Format: JPG, PNG, GIF (Maks. 2MB)</p>
                    @error('image')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Main Icon Section -->
                <div class="main-icon-section bg-blue-50 p-4 rounded-xl border border-blue-100"
                    style="display: {{ old('display_type', $facility->display_type) === 'icon' ? 'block' : 'none' }}">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Icon Utama
                    </label>
                    <div class="relative">
                        <input type="text" readonly
                            class="main-icon-picker w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 bg-white cursor-pointer"
                            value="{{ old('main_icon', $facility->main_icon) }}">
                        <input type="hidden" name="main_icon" value="{{ old('main_icon', $facility->main_icon) }}">
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-gray-500">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    @error('main_icon')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Icon Pendukung -->
            <div class="mt-6 bg-yellow-50 p-4 rounded-xl border border-yellow-100">
                <label class="block text-sm font-medium text-gray-700 mb-2" for="icon">
                    Icon Pendukung
                </label>
                <div class="relative">
                    <input type="text" readonly
                        class="icon-picker w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 bg-white cursor-pointer"
                        value="{{ old('icon', $facility->icon) }}">
                    <input type="hidden" name="icon" value="{{ old('icon', $facility->icon) }}">
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-gray-500">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <!-- Durasi -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="duration">Informasi Waktu/Durasi</label>
                <input type="text" name="duration" id="duration" value="{{ old('duration', $facility->duration) }}"
                    class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2 text-gray-700 placeholder-gray-400 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary/50 hover:border-primary/70 transition-all duration-200 @error('duration') border-red-500 focus:ring-red-500 @enderror"
                    placeholder="Contoh: Buka 24 Jam, 2-3 jam bermain">
            </div>

            <!-- Kategori -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="type">Kategori</label>
                <select name="type" id="type"
                    class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary/50 hover:border-primary/70 transition-all duration-200">
                    <option value="wahana" {{ old('type', $facility->type) === 'wahana' ? 'selected' : '' }}>Wahana Permainan/Hiburan</option>
                    <option value="fasilitas" {{ old('type', $facility->type) === 'fasilitas' ? 'selected' : '' }}>Fasilitas Umum</option>
                </select>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end space-x-3 border-t border-gray-100 pt-6 mt-8">
                <a href="{{ route('admin.facilities.index') }}"
                    class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-600 bg-white hover:bg-gray-100 hover:text-gray-800 transition-all duration-200 flex items-center">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-gradient-to-r from-primary to-indigo-500 text-white rounded-lg shadow-md hover:from-indigo-600 hover:to-primary transition-all duration-200 flex items-center">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- FontAwesome Icon Picker -->
    <script src="https://cdn.jsdelivr.net/npm/fontawesome-iconpicker@3.2.0/dist/js/fontawesome-iconpicker.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Both Icon Pickers with common settings
            const iconPickerSettings = {
                title: 'Pilih Icon',
                selected: true,
                placement: 'bottom',
                collision: 'none',
                animation: true,
                hideOnSelect: true,
                templates: {
                    popover: '<div class="iconpicker-popover popover shadow-lg"><div class="arrow"></div>' +
                            '<div class="popover-title bg-gray-50 rounded-t-lg"></div><div class="popover-content"></div></div>',
                    footer: '<div class="popover-footer p-2 bg-gray-50 rounded-b-lg text-right"></div>',
                    buttons: '<button class="iconpicker-btn text-sm px-3 py-1 bg-primary text-white rounded hover:bg-secondary">Pilih</button>',
                    search: '<input type="search" class="iconpicker-search mb-2" placeholder="Cari icon...">'
                }
            };

            // Initialize Main Icon Picker (for Icon Option)
            $('.main-icon-picker').iconpicker({
                ...iconPickerSettings,
                defaultValue: 'fas fa-landmark'
            }).on('iconpickerSelected', function(e) {
                $(this).siblings('input[type="hidden"]').val(e.iconpickerValue);
            });

            // Initialize Additional Icon Picker
            $('.icon-picker').iconpicker({
                ...iconPickerSettings,
                defaultValue: 'fas fa-hiking'
            }).on('iconpickerSelected', function(e) {
                $(this).siblings('input[type="hidden"]').val(e.iconpickerValue);
            });

            // Handle display type toggle
            $('input[name="display_type"]').change(function() {
                if ($(this).val() === 'image') {
                    $('.image-section').fadeIn();
                    $('.main-icon-section').fadeOut();
                } else {
                    $('.image-section').fadeOut();
                    $('.main-icon-section').fadeIn();
                }
            });
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
                const preview = document.getElementById('imagePreview');
                const placeholder = document.querySelector('.image-preview-placeholder');

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
@endsection
