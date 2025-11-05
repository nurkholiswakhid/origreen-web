@extends('admin.layouts.app')

@section('title', 'Edit Pengaturan Peta')

@section('content')
<div class="mb-6">
    <div class="flex items-center gap-3">
        <div class="bg-primary bg-opacity-10 p-2 rounded-lg">
            <i class="fas fa-map-marked-alt text-2xl text-primary"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Pengaturan Peta</h1>
            <p class="text-gray-600 text-sm">Kelola informasi lokasi dan kontak perusahaan</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
    <div class="border-b border-gray-100 bg-gray-50 px-6 py-4">
        <h2 class="font-medium text-gray-700 flex items-center gap-2">
            <i class="fas fa-info-circle text-primary"></i>
            Informasi Kontak & Lokasi
        </h2>
    </div>
    <form action="{{ route('admin.map-settings.update') }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <!-- Address Section -->
            <div class="bg-gray-50 rounded-lg p-4 border-2 border-gray-200 hover:border-primary transition-colors duration-300">
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-map-marker-alt text-primary mr-2"></i>Alamat Lengkap
                </label>
                <div class="relative">
                    <textarea name="address" id="address" rows="3" required
                              class="w-full rounded-lg border-2 border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300 pl-4 pr-10"
                              placeholder="Masukkan alamat lengkap perusahaan">{{ old('address', $mapSetting->address ?? '') }}</textarea>
                    <div class="absolute right-3 top-3 text-gray-400">
                        <i class="fas fa-building"></i>
                    </div>
                </div>
                @error('address')
                    <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Contact Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Phone -->
                <div class="bg-gray-50 rounded-lg p-4 border-2 border-gray-200 hover:border-primary transition-colors duration-300">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-phone text-primary mr-2"></i>Nomor Telepon
                    </label>
                    <div class="relative">
                        <input type="text" name="phone" id="phone" required
                               value="{{ old('phone', $mapSetting->phone ?? '') }}"
                               class="w-full rounded-lg border-2 border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300 pl-10"
                               placeholder="Contoh: +62 812 3456 7890">
                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                    </div>
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="bg-gray-50 rounded-lg p-4 border-2 border-gray-200 hover:border-primary transition-colors duration-300">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope text-primary mr-2"></i>Alamat Email
                    </label>
                    <div class="relative">
                        <input type="email" name="email" id="email" required
                               value="{{ old('email', $mapSetting->email ?? '') }}"
                               class="w-full rounded-lg border-2 border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300 pl-10"
                               placeholder="Contoh: info@origreen.com">
                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class="fas fa-at"></i>
                        </div>
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Operation Hours -->
            <div class="bg-gray-50 rounded-lg p-4 border-2 border-gray-200 hover:border-primary transition-colors duration-300">
                <label for="operation_hours" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-clock text-primary mr-2"></i>Jam Operasional
                </label>
                <div class="relative">
                    <input type="text" name="operation_hours" id="operation_hours" required
                           value="{{ old('operation_hours', $mapSetting->operation_hours ?? '') }}"
                           class="w-full rounded-lg border-2 border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300 pl-10"
                           placeholder="Contoh: Senin - Minggu: 08.00 - 17.00 WIB">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="far fa-clock"></i>
                    </div>
                </div>
                @error('operation_hours')
                    <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Google Maps URL -->
            <div class="bg-gray-50 rounded-lg p-4 border-2 border-gray-200 hover:border-primary transition-colors duration-300">
                <label for="google_maps_url" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-map-marked-alt text-primary mr-2"></i>URL Google Maps
                </label>
                <div class="relative">
                    <input type="url" name="google_maps_url" id="google_maps_url" required
                           value="{{ old('google_maps_url', $mapSetting->google_maps_url ?? '') }}"
                           class="w-full rounded-lg border-2 border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300 pl-10"
                           placeholder="https://maps.google.com/...">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="fab fa-google"></i>
                    </div>
                </div>
                @error('google_maps_url')
                    <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror
                <p class="mt-2 text-xs text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i>
                    Masukkan URL dari Google Maps yang menunjukkan lokasi perusahaan
                </p>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="mt-8 flex justify-end space-x-4">
            <button type="submit"
                    class="inline-flex items-center px-6 py-3 border-2 border-primary bg-primary rounded-lg text-white hover:bg-secondary hover:border-secondary transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transform hover:scale-105">
                <i class="fas fa-save mr-2"></i>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
