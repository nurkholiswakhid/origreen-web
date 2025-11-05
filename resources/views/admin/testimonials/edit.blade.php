@extends('admin.layouts.app')

@section('title', 'Edit Testimoni')

@section('content')
<div class="mb-6">
    <div class="flex items-center gap-3">
        <div class="bg-primary bg-opacity-10 p-2 rounded-lg">
            <i class="fas fa-edit text-2xl text-primary"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Testimoni</h1>
            <p class="text-gray-600 text-sm">Perbarui data testimonial pelanggan</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
    <div class="border-b border-gray-100 bg-gray-50 px-6 py-4">
        <h2 class="font-medium text-gray-700">Form Edit Testimoni</h2>
    </div>
    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama -->
                <div class="form-group">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" name="name" id="name" required value="{{ old('name', $testimonial->name) }}"
                               class="pl-10 w-full rounded-lg border-2 border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300"
                               placeholder="Masukkan nama pelanggan">
                    </div>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pekerjaan -->
                <div class="form-group">
                    <label for="occupation" class="block text-sm font-medium text-gray-700">Pekerjaan/Asal</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-briefcase text-gray-400"></i>
                        </div>
                        <input type="text" name="occupation" id="occupation" value="{{ old('occupation', $testimonial->occupation) }}"
                               class="pl-10 w-full rounded-lg border-2 border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300"
                               placeholder="Masukkan pekerjaan/asal">
                    </div>
                    @error('occupation')
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Avatar Upload -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Avatar Pelanggan</label>
                <div class="flex items-start space-x-6">
                    <div class="flex-shrink-0">
                        <div id="avatar-preview" class="h-32 w-32 rounded-lg border-2 border-gray-200 overflow-hidden relative group">
                            <img src="{{ old('avatar_url', $testimonial->avatar_url) ?? asset('images/default-avatar.png') }}"
                                 alt="Avatar Preview"
                                 class="w-full h-full object-cover transition duration-300 group-hover:opacity-75">
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="text-white text-sm">Ganti Avatar</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="relative">
                            <input type="file" id="avatar_image" name="avatar_image" accept="image/*"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                   onchange="handleImageUpload(this)">
                            <div id="upload-placeholder"
                                 class="w-full border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-colors cursor-pointer">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-gray-600">
                                    <span class="text-primary">Klik untuk upload</span> atau drag and drop
                                </p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 2MB</p>
                            </div>
                            <input type="hidden" name="avatar_url" id="avatar_url" value="{{ old('avatar_url', $testimonial->avatar_url) }}">
                        </div>
                        @error('avatar_url')
                            <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Ulasan -->
            <div class="mt-6">
                <label for="content" class="block text-sm font-medium text-gray-700">Ulasan</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <textarea name="content" id="content" rows="4" required
                              class="w-full rounded-lg border-2 border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300"
                              placeholder="Masukkan ulasan pelanggan">{{ old('content', $testimonial->content) }}</textarea>
                </div>
                @error('content')
                    <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <!-- Rating -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Rating Pelanggan</label>
                <div class="bg-gray-50 rounded-lg p-4 border-2 border-gray-200">
                    <div class="flex items-center space-x-2">
                        @for($i = 1; $i <= 5; $i++)
                        <button type="button" onclick="setRating({{ $i }})"
                                class="text-3xl hover:scale-110 transition-transform duration-200 focus:outline-none star-button">
                            <i class="fas fa-star"></i>
                        </button>
                        @endfor
                        <span class="ml-2 text-sm text-gray-600" id="rating-text">{{ $testimonial->rating }} Bintang</span>
                    </div>
                </div>
                <input type="hidden" name="rating" id="rating" value="{{ old('rating', $testimonial->rating) }}">
                @error('rating')
                    <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Testimonial</label>
                <div class="bg-gray-50 rounded-lg p-4 border-2 border-gray-200">
                    <label class="inline-flex items-center cursor-pointer group">
                        <input type="checkbox" name="is_active" value="1" {{ $testimonial->is_active ? 'checked' : '' }}
                               class="rounded border-2 border-gray-300 text-primary focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-colors w-5 h-5">
                        <span class="ml-2 text-gray-700 group-hover:text-primary transition-colors">Aktif</span>
                    </label>
                    <p class="text-xs text-gray-500 mt-1">Testimonial akan langsung ditampilkan jika status aktif</p>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="mt-8 flex items-center justify-end space-x-4">
            <a href="{{ route('admin.testimonials.index') }}"
               class="inline-flex items-center px-4 py-2 border-2 border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
            <button type="submit"
                    class="inline-flex items-center px-6 py-2 border-2 border-primary bg-primary rounded-lg text-white hover:bg-secondary hover:border-secondary transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transform hover:scale-105">
                <i class="fas fa-save mr-2"></i>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<style>
    .star-button:hover ~ .star-button i {
        color: #D1D5DB !important;
    }
    .star-button i {
        transition: all 0.2s ease;
    }
</style>
<script>
function handleImageUpload(input) {
    const preview = document.getElementById('avatar-preview').querySelector('img');
    const placeholder = document.getElementById('upload-placeholder');

    if (input.files && input.files[0]) {
        // Size validation (2MB)
        if (input.files[0].size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 2MB');
            input.value = '';
            return;
        }

        const formData = new FormData();
        formData.append('image', input.files[0]);
        formData.append('_token', '{{ csrf_token() }}');

        // Show loading state
        placeholder.innerHTML = `
            <div class="text-center">
                <i class="fas fa-spinner fa-spin text-4xl text-primary mb-2"></i>
                <p class="text-gray-600">Mengupload gambar...</p>
            </div>
        `;

        // Upload to server
        fetch('{{ route("admin.upload-image") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            preview.src = data.location;
            document.getElementById('avatar_url').value = data.location;
            resetPlaceholder();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal mengupload gambar. Silakan coba lagi.');
            resetPlaceholder();
        });
    }
}

function resetPlaceholder() {
    const placeholder = document.getElementById('upload-placeholder');
    placeholder.innerHTML = `
        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
        <p class="text-gray-600">
            <span class="text-primary">Klik untuk upload</span> atau drag and drop
        </p>
        <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 2MB</p>
    `;
}

function setRating(rating) {
    document.getElementById('rating').value = rating;
    const ratingText = document.getElementById('rating-text');

    document.querySelectorAll('.star-button').forEach((button, index) => {
        const star = button.querySelector('i');
        if (index < rating) {
            star.classList.add('text-yellow-400');
            star.classList.remove('text-gray-300');
        } else {
            star.classList.remove('text-yellow-400');
            star.classList.add('text-gray-300');
        }
    });

    // Update rating text
    ratingText.textContent = `${rating} Bintang`;
}

// Setup drag and drop
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
            const input = document.getElementById('avatar_image');
            input.files = files;
            handleImageUpload(input);
        }
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    setRating({{ old('rating', $testimonial->rating) }});
    setupDragAndDrop();
});
</script>
@endpush
@endsection
