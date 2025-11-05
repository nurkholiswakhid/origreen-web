@extends('admin.layouts.app')

@section('title', 'Edit Wahana/Fasilitas')

@push('styles')
    <!-- FontAwesome Icon Picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fontawesome-iconpicker@3.2.0/dist/css/fontawesome-iconpicker.min.css">
    <style>
        .image-preview-wrapper {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
            background: #f3f4f6;
            border-radius: 0.5rem;
            overflow: hidden;
            cursor: pointer;
        }
        .image-preview-wrapper img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .image-preview-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #9ca3af;
        }
        .image-preview-wrapper:hover .image-preview-overlay {
            opacity: 1;
        }
        .image-preview-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s;
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
    </style>
@endpush

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Edit Wahana/Fasilitas</h1>
        <p class="text-sm text-gray-600 mt-1">Ubah informasi wahana atau fasilitas yang sudah ada</p>
    </div>
    <a href="{{ route('admin.facilities.index') }}"
        class="bg-white border-2 border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors flex items-center group">
        <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
        Kembali
    </a>
</div>

<div class="bg-white rounded-xl shadow-lg border border-gray-100">
    <div class="border-b border-gray-100 bg-gray-50 px-6 py-4">
        <div class="flex items-center text-gray-600">
            <i class="fas fa-edit text-primary mr-2"></i>
            <span>Form Edit Data</span>
        </div>
    </div>
    <div class="p-6">
        <form action="{{ route('admin.facilities.update', $facility) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Media Type Selection -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-images text-primary mr-2"></i>
                        <span>Pilih Tampilan Utama</span>
                        <span class="text-red-500 ml-1">*</span>
                    </div>
                    <span class="text-gray-500 text-xs block mt-1">Pilih salah satu untuk tampilan utama fasilitas/wahana</span>
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Image Option -->
                    <label class="block p-4 bg-white border-2 {{ $facility->display_type === 'image' ? 'border-primary' : 'border-gray-200' }} rounded-xl cursor-pointer hover:border-primary transition-colors group">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <input type="radio" name="display_type" value="image" class="hidden" {{ old('display_type', $facility->display_type) === 'image' ? 'checked' : '' }}>
                                <div class="w-12 h-12 {{ $facility->display_type === 'image' ? 'bg-blue-100' : 'bg-blue-50' }} rounded-lg flex items-center justify-center text-blue-500 group-hover:bg-blue-100 transition-colors">
                                    <i class="fas fa-image text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-grow">
                                <h3 class="font-medium text-gray-800">Gambar/Foto</h3>
                                <p class="text-sm text-gray-500">Upload foto wahana/fasilitas</p>
                            </div>
                        </div>
                    </label>
                    <!-- Icon Option -->
                    <label class="block p-4 bg-white border-2 {{ $facility->display_type === 'icon' ? 'border-primary' : 'border-gray-200' }} rounded-xl cursor-pointer hover:border-primary transition-colors group">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <input type="radio" name="display_type" value="icon" class="hidden" {{ old('display_type', $facility->display_type) === 'icon' ? 'checked' : '' }}>
                                <div class="w-12 h-12 {{ $facility->display_type === 'icon' ? 'bg-indigo-100' : 'bg-indigo-50' }} rounded-lg flex items-center justify-center text-indigo-500 group-hover:bg-indigo-100 transition-colors">
                                    <i class="fas fa-icons text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-grow">
                                <h3 class="font-medium text-gray-800">Icon</h3>
                                <p class="text-sm text-gray-500">Pilih icon yang mewakili</p>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 bg-gray-50 p-6 rounded-xl mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="name">
                        Nama Wahana/Fasilitas
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-tag"></i>
                        </span>
                        <input type="text" name="name" id="name" value="{{ old('name', $facility->name) }}"
                            class="w-full pl-10 rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('name') border-red-500 @enderror"
                            placeholder="Masukkan nama wahana atau fasilitas">
                    </div>
                    @error('name')
                        <p class="mt-1 text-sm text-red-500 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="description">
                        Deskripsi
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <textarea name="description" id="description" rows="3"
                            class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('description') border-red-500 @enderror"
                            placeholder="Jelaskan detail tentang wahana atau fasilitas ini">{{ old('description', $facility->description) }}</textarea>
                        <div class="absolute right-2 bottom-2 text-gray-400">
                            <i class="fas fa-paragraph"></i>
                        </div>
                    </div>
                    @error('description')
                        <p class="mt-1 text-sm text-red-500 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Media Content -->
            <div class="space-y-6">
                <!-- Image Upload Section -->
                <div class="image-section bg-blue-50 p-4 rounded-lg" style="display: {{ old('display_type', $facility->display_type) === 'image' ? 'block' : 'none' }}">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Upload Foto Fasilitas/Wahana
                        <span class="text-gray-500 text-xs block mt-1">Foto akan ditampilkan sebagai tampilan utama</span>
                    </label>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="image-preview-wrapper mb-3" onclick="document.getElementById('image').click()">
                            <img id="imagePreview"
                                 src="{{ $facility->image_url ? Storage::url($facility->image_url) : '' }}"
                                 alt=""
                                 style="display: {{ $facility->image_url ? 'block' : 'none' }}"
                                 class="object-cover w-full h-full rounded-lg">
                            <div class="image-preview-placeholder" style="display: {{ $facility->image_url ? 'none' : 'block' }}">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="image-preview-overlay">
                                <span class="bg-white rounded-lg px-4 py-2 text-sm font-medium text-gray-700">
                                    <i class="fas fa-edit mr-2"></i>Ganti Foto
                                </span>
                            </div>
                        </div>

                        <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                        <p class="text-gray-500 text-xs text-center">Format: JPG, PNG, GIF (Maks. 2MB)</p>

                        @error('image')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Main Icon Section -->
                <div class="main-icon-section bg-blue-50 p-4 rounded-lg" style="display: {{ old('display_type', $facility->display_type) === 'icon' ? 'block' : 'none' }}">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="main_icon">
                            Icon Utama
                            <span class="text-gray-500 text-xs block mt-1">Icon ini akan ditampilkan sebagai tampilan utama</span>
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
                    </div>
                </div>
            </div>

            <!-- Additional Fields -->
            <div class="mb-4 bg-yellow-50 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2" for="icon">
                    Icon Pendukung
                    <span class="text-gray-500 text-xs block mt-1">Icon kecil yang menandakan kategori atau jenis fasilitas/wahana</span>
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
                @error('icon')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="duration">
                    Informasi Waktu/Durasi
                </label>
                <input type="text" name="duration" id="duration" value="{{ old('duration', $facility->duration) }}"
                    class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('duration') border-red-500 @enderror"
                    placeholder="Contoh: Buka 24 Jam, 2-3 jam bermain">
                <p class="text-gray-500 text-xs mt-1">Masukkan informasi waktu seperti: durasi bermain, jam operasional, atau periode penggunaan</p>
                @error('duration')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="type">
                    Kategori
                    <span class="text-gray-500 text-xs block mt-1">Pilih kategori yang sesuai</span>
                </label>
                <select name="type" id="type"
                    class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('type') border-red-500 @enderror">
                    <option value="wahana" {{ old('type', $facility->type) === 'wahana' ? 'selected' : '' }}>Wahana Permainan/Hiburan</option>
                    <option value="fasilitas" {{ old('type', $facility->type) === 'fasilitas' ? 'selected' : '' }}>Fasilitas Umum</option>
                </select>
                <p class="text-gray-500 text-xs mt-1">Wahana untuk area permainan/hiburan, Fasilitas untuk sarana pendukung seperti toilet, tempat ibadah, dll</p>
                @error('type')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="order">
                    Urutan Tampilan
                </label>
                <input type="number" name="order" id="order" value="{{ old('order', $facility->order) }}"
                    class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('order') border-red-500 @enderror"
                    placeholder="Masukkan angka urutan tampilan">
                <p class="text-gray-500 text-xs mt-1">Urutan tampilan di halaman utama, semakin kecil angka semakin di atas posisinya</p>
                @error('order')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Status
                </label>
                <div class="flex items-center space-x-6">
                    <label class="inline-flex items-center">
                        <input type="radio" name="is_active" value="1"
                               {{ old('is_active', $facility->is_active) ? 'checked' : '' }}
                               class="text-primary focus:ring-primary">
                        <span class="ml-2 text-sm text-gray-700">Aktif</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="is_active" value="0"
                               {{ old('is_active', $facility->is_active) ? '' : 'checked' }}
                               class="text-primary focus:ring-primary">
                        <span class="ml-2 text-sm text-gray-700">Nonaktif</span>
                    </label>
                </div>
                <p class="text-gray-500 text-xs mt-1">Pilih status aktif untuk menampilkan di halaman utama</p>
                @error('is_active')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

                            <div class="flex items-center justify-end space-x-3 border-t border-gray-100 pt-6">
                <a href="{{ route('admin.facilities.index') }}"
                    class="px-6 py-2.5 rounded-lg border-2 border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors inline-flex items-center">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-lg hover:bg-secondary transition-colors inline-flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
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
