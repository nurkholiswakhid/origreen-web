@extends('admin.layouts.app')

@section('title', 'Edit Social Media')

@push('styles')
<!-- FontAwesome Icon Picker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fontawesome-iconpicker@3.2.0/dist/css/fontawesome-iconpicker.min.css">
@endpush

@section('content')
<div class="animate-fade-in">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-share-alt text-primary"></i>
            Edit Social Media
        </h1>
        <p class="text-sm text-gray-600 mt-1">Perbarui informasi social media yang sudah ada</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <form action="{{ route('admin.social-media.update', ['socialMedia' => $socialMedia->id]) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="platform" class="block text-sm font-medium text-gray-700 mb-1">Platform</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-laptop text-gray-400"></i>
                        </div>
                        <input type="text"
                            class="w-full pl-10 rounded-lg border border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 @error('platform') border-red-500 @enderror"
                            id="platform"
                            name="platform"
                            value="{{ old('platform', $socialMedia->platform) }}"
                            placeholder="Contoh: Facebook, Instagram, dll"
                            required>
                    </div>
                    @error('platform')
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700 mb-1">URL</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-link text-gray-400"></i>
                        </div>
                        <input type="url"
                            class="w-full pl-10 rounded-lg border border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 @error('url') border-red-500 @enderror"
                            id="url"
                            name="url"
                            value="{{ old('url', $socialMedia->url) }}"
                            placeholder="https://example.com"
                            required>
                    </div>
                    @error('url')
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Icon</label>
                <div class="flex space-x-3 items-start">
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-icons text-gray-400"></i>
                            </div>
                            <input type="text"
                                class="w-full pl-10 pr-10 rounded-lg border border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 @error('icon') border-red-500 @enderror icon-picker"
                                id="icon"
                                value="{{ old('icon', $socialMedia->icon) }}"
                                placeholder="Klik untuk memilih icon"
                                readonly
                                required>
                            <input type="hidden" name="icon" value="{{ old('icon', $socialMedia->icon) }}">
                        </div>
                        <div class="relative">
                            <div id="iconPreview" class="mt-2 p-3 bg-gray-50 border border-gray-200 rounded-lg flex items-center gap-3">
                                <div class="w-10 h-10 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-100">
                                    <i id="iconDisplay" class="{{ old('icon', $socialMedia->icon) }} text-xl text-primary"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Preview Icon</p>
                                    <p class="text-xs text-gray-500 truncate">Pastikan icon yang dipilih sudah sesuai</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-48">
                        <div class="p-3 bg-gray-50 border border-gray-200 rounded-lg">
                            <p class="text-xs font-medium text-gray-900 mb-2">Rekomendasi Icon:</p>
                            <div class="space-y-2">
                                <button type="button" class="w-full px-3 py-2 text-left text-sm bg-white border border-gray-300 rounded hover:border-primary transition-colors flex items-center gap-2 icon-suggestion" data-icon="fab fa-facebook">
                                    <i class="fab fa-facebook text-blue-600"></i>
                                    <span class="text-gray-600">Facebook</span>
                                </button>
                                <button type="button" class="w-full px-3 py-2 text-left text-sm bg-white border border-gray-300 rounded hover:border-primary transition-colors flex items-center gap-2 icon-suggestion" data-icon="fab fa-instagram">
                                    <i class="fab fa-instagram text-pink-600"></i>
                                    <span class="text-gray-600">Instagram</span>
                                </button>
                                <button type="button" class="w-full px-3 py-2 text-left text-sm bg-white border border-gray-300 rounded hover:border-primary transition-colors flex items-center gap-2 icon-suggestion" data-icon="fab fa-twitter">
                                    <i class="fab fa-twitter text-blue-400"></i>
                                    <span class="text-gray-600">Twitter</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mt-2 text-sm text-gray-500 flex items-center gap-1">
                    <i class="fas fa-info-circle text-gray-400"></i>
                    Klik pada input untuk membuka pemilih icon, atau pilih dari rekomendasi
                    <a href="https://fontawesome.com/v5/search?o=r&m=free&f=brands" 
                       target="_blank" 
                       class="text-primary hover:text-primary-dark inline-flex items-center gap-1 ml-1">
                        Lihat semua icon
                        <i class="fas fa-external-link-alt text-xs"></i>
                    </a>
                </p>
                @error('icon')
                    <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-sort-numeric-down text-gray-400"></i>
                        </div>
                        <input type="number"
                            class="w-full pl-10 rounded-lg border border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 @error('sort_order') border-red-500 @enderror"
                            id="sort_order"
                            name="sort_order"
                            value="{{ old('sort_order', $socialMedia->sort_order) }}"
                            min="0"
                            placeholder="Masukkan urutan tampilan"
                            required>
                    </div>
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox"
                            class="sr-only peer"
                            id="is_active"
                            name="is_active"
                            value="1"
                            {{ old('is_active', $socialMedia->is_active) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        <span class="ms-3 text-sm font-medium text-gray-700">Aktif</span>
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6">
                <a href="{{ route('admin.social-media.index') }}" 
                   class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/20">
                    <i class="fas fa-times mr-2 text-gray-400"></i>
                    Batal
                </a>
                <button type="submit" 
                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-primary border border-transparent rounded-lg hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fontawesome-iconpicker@3.2.0/dist/js/fontawesome-iconpicker.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize icon picker
    $('.icon-picker').iconpicker({
        title: 'Pilih Icon',
        selected: true,
        placement: 'bottom',
        collision: 'none',
        hideOnSelect: true,
        templates: {
            search: '<input type="search" class="form-control iconpicker-search" placeholder="Cari icon..." />'
        }
    }).on('iconpickerSelected', function(e) {
        const selectedIcon = e.iconpickerValue;
        $(this).siblings('input[type="hidden"]').val(selectedIcon);
        updateIconPreview(selectedIcon);
    });

    // Icon suggestion buttons
    $('.icon-suggestion').on('click', function() {
        const icon = $(this).data('icon');
        $('.icon-picker').val(icon);
        $('input[name="icon"]').val(icon);
        updateIconPreview(icon);
    });

    // Initialize with existing value
    const initialIcon = $('input[name="icon"]').val();
    if (initialIcon) {
        updateIconPreview(initialIcon);
        $('.icon-picker').val(initialIcon);
    }

    function updateIconPreview(iconClass) {
        const iconDisplay = document.getElementById('iconDisplay');
        iconDisplay.className = iconClass + ' text-xl text-primary';
    }
});
</script>
@endpush

@endsection
