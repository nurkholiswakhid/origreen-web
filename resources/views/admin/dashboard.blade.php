@extends('admin.layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-primary/10 text-primary">
                <i class="fas fa-users text-3xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500">Total Pengunjung</p>
                <h3 class="text-2xl font-bold text-gray-700">50K+</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-secondary/10 text-secondary">
                <i class="fas fa-ticket-alt text-3xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500">Tiket Terjual</p>
                <h3 class="text-2xl font-bold text-gray-700">1.2K</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-star text-3xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500">Rating</p>
                <h3 class="text-2xl font-bold text-gray-700">4.8/5.0</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-comments text-3xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500">Testimoni</p>
                <h3 class="text-2xl font-bold text-gray-700">500+</h3>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('admin.banner.edit') }}" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-primary hover:text-white transition-colors">
                <i class="fas fa-image text-xl"></i>
                <span class="ml-3">Edit Banner</span>
            </a>
            <a href="#" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-primary hover:text-white transition-colors">
                <i class="fas fa-cog text-xl"></i>
                <span class="ml-3">Pengaturan</span>
            </a>
            <a href="{{ url('/') }}" target="_blank" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-primary hover:text-white transition-colors">
                <i class="fas fa-external-link-alt text-xl"></i>
                <span class="ml-3">Lihat Website</span>
            </a>
            <a href="#" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-primary hover:text-white transition-colors">
                <i class="fas fa-user text-xl"></i>
                <span class="ml-3">Profile</span>
            </a>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Aktivitas Terbaru</h2>
        <div class="space-y-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-edit text-blue-500"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-900">Banner diperbarui</p>
                    <p class="text-sm text-gray-500">2 jam yang lalu</p>
                </div>
            </div>

            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                        <i class="fas fa-user-check text-green-500"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-900">Login berhasil</p>
                    <p class="text-sm text-gray-500">5 jam yang lalu</p>
                </div>
            </div>

            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center">
                        <i class="fas fa-star text-yellow-500"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-900">Testimoni baru diterima</p>
                    <p class="text-sm text-gray-500">1 hari yang lalu</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
