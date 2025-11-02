@extends('admin.layouts.app')

@section('title', 'Tambah Wahana/Fasilitas')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Tambah Wahana/Fasilitas</h1>
    <a href="{{ route('admin.facilities.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow-md">
    <div class="p-6">
        <form action="{{ route('admin.facilities.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="name">
                    Nama
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="description">
                    Deskripsi
                </label>
                <textarea name="description" id="description" rows="3"
                    class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('description') border-red-500 @enderror"
                    >{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="icon">
                    Icon (Font Awesome Class)
                </label>
                <div class="flex space-x-2">
                    <input type="text" name="icon" id="icon" value="{{ old('icon', 'fas fa-') }}"
                        class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('icon') border-red-500 @enderror">
                    <div class="w-10 h-10 bg-gray-50 rounded-md flex items-center justify-center text-lg text-primary" id="icon-preview">
                        <i class="{{ old('icon', 'fas fa-star') }}"></i>
                    </div>
                </div>
                <p class="text-gray-500 text-xs mt-1">Contoh: fas fa-hiking, fas fa-water, dll</p>
                @error('icon')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="duration">
                    Durasi/Info Tambahan
                </label>
                <input type="text" name="duration" id="duration" value="{{ old('duration') }}"
                    class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('duration') border-red-500 @enderror">
                <p class="text-gray-500 text-xs mt-1">Contoh: 2-3 jam, 24/7 Security, dll</p>
                @error('duration')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="type">
                    Tipe
                </label>
                <select name="type" id="type"
                    class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('type') border-red-500 @enderror">
                    <option value="wahana" {{ old('type') === 'wahana' ? 'selected' : '' }}>Wahana</option>
                    <option value="fasilitas" {{ old('type') === 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="order">
                    Urutan
                </label>
                <input type="number" name="order" id="order" value="{{ old('order', 0) }}"
                    class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('order') border-red-500 @enderror">
                @error('order')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition-colors">
                Simpan
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const iconInput = document.getElementById('icon');
    const iconPreview = document.getElementById('icon-preview');

    iconInput.addEventListener('input', function() {
        iconPreview.innerHTML = `<i class="${this.value}"></i>`;
    });
</script>
@endpush
@endsection
