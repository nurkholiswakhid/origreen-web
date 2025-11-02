@extends('admin.layouts.app')

@section('title', 'Edit Pengaturan Peta')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Pengaturan Peta</h1>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <form action="{{ route('admin.map-settings.update') }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="address" id="address" rows="3" required
                          class="mt-1 w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">{{ old('address', $mapSetting->address ?? '') }}</textarea>
                @error('address')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Telepon</label>
                <input type="text" name="phone" id="phone" required value="{{ old('phone', $mapSetting->phone ?? '') }}"
                       class="mt-1 w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required value="{{ old('email', $mapSetting->email ?? '') }}"
                       class="mt-1 w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="operation_hours" class="block text-sm font-medium text-gray-700">Jam Operasional</label>
                <input type="text" name="operation_hours" id="operation_hours" required value="{{ old('operation_hours', $mapSetting->operation_hours ?? '') }}"
                       class="mt-1 w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                       placeholder="Contoh: Senin - Minggu: 08.00 - 17.00 WIB">
                @error('operation_hours')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="google_maps_url" class="block text-sm font-medium text-gray-700">URL Google Maps</label>
                <input type="url" name="google_maps_url" id="google_maps_url" required value="{{ old('google_maps_url', $mapSetting->google_maps_url ?? '') }}"
                       class="mt-1 w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                       placeholder="https://maps.google.com/...">
                @error('google_maps_url')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
