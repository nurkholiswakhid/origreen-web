@extends('admin.layouts.app')

@section('title', 'Edit Wahana/Fasilitas')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Edit Wahana/Fasilitas</h1>
    <a href="{{ route('admin.facilities.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow-md">
    <div class="p-6">

        <form action="{{ route('admin.facilities.update', $facility) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Nama
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $facility->name) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="description">
                        Deskripsi
                    </label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('description') border-red-500 @enderror"
                        >{{ old('description', $facility->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="icon">
                        Icon (Font Awesome Class)
                    </label>
                    <div class="flex space-x-2">
                        <input type="text" name="icon" id="icon" value="{{ old('icon', $facility->icon) }}"
                            class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('icon') border-red-500 @enderror">
                        <div class="w-10 h-10 bg-gray-50 rounded-md flex items-center justify-center text-lg text-primary" id="icon-preview">
                            <i class="{{ old('icon', $facility->icon) }}"></i>
                        </div>
                    </div>
                    @error('icon')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="duration">
                        Durasi/Info Tambahan
                    </label>
                    <input type="text" name="duration" id="duration" value="{{ old('duration', $facility->duration) }}"
                        class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('duration') border-red-500 @enderror">
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
                        <option value="wahana" {{ old('type', $facility->type) === 'wahana' ? 'selected' : '' }}>Wahana</option>
                        <option value="fasilitas" {{ old('type', $facility->type) === 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="order">
                        Urutan
                    </label>
                    <input type="number" name="order" id="order" value="{{ old('order', $facility->order) }}"
                        class="w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('order') border-red-500 @enderror">
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
                    @error('is_active')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition-colors">
                    Simpan Perubahan
                </button>            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="icon">
                    Icon (Font Awesome Class)
                </label>
                <div class="flex space-x-2">
                    <input type="text" name="icon" id="icon" value="{{ old('icon', $facility->icon) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <div class="w-10 h-10 bg-gray-100 rounded flex items-center justify-center text-lg" id="icon-preview">
                        <i class="{{ $facility->icon }}"></i>
                    </div>
                </div>
                <p class="text-gray-500 text-xs mt-1">Contoh: fas fa-hiking, fas fa-water, dll</p>
                @error('icon')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="duration">
                    Durasi/Info Tambahan
                </label>
                <input type="text" name="duration" id="duration" value="{{ old('duration', $facility->duration) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p class="text-gray-500 text-xs mt-1">Contoh: 2-3 jam, 24/7 Security, dll</p>
                @error('duration')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                    Tipe
                </label>
                <select name="type" id="type"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="wahana" {{ old('type', $facility->type) === 'wahana' ? 'selected' : '' }}>Wahana</option>
                    <option value="fasilitas" {{ old('type', $facility->type) === 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="order">
                    Urutan
                </label>
                <input type="number" name="order" id="order" value="{{ old('order', $facility->order) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('order')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-primary text-white font-bold py-2 px-4 rounded hover:bg-secondary focus:outline-none focus:shadow-outline">
                    Simpan Perubahan
                </button>
            </div>
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
