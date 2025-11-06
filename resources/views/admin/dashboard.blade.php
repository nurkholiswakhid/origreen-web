@extends('admin.layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-primary/10 text-primary">
                <i class="fas fa-newspaper text-3xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500">Total Berita</p>
                <h3 class="text-2xl font-bold text-gray-700">{{ $statistics['news_count'] ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-building text-3xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500">Total Fasilitas</p>
                <h3 class="text-2xl font-bold text-gray-700">{{ $statistics['facilities_count'] ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-comments text-3xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500">Total Testimoni</p>
                <h3 class="text-2xl font-bold text-gray-700">{{ $statistics['testimonials_count'] ?? 0 }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Menu Cepat</h2>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('admin.news.create') }}" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-primary hover:text-white transition-colors">
                <i class="fas fa-newspaper text-xl"></i>
                <span class="ml-3">Tambah Berita</span>
            </a>
            <a href="{{ route('admin.facilities.create') }}" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-primary hover:text-white transition-colors">
                <i class="fas fa-building text-xl"></i>
                <span class="ml-3">Tambah Fasilitas</span>
            </a>
            <a href="{{ route('admin.banner.edit') }}" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-primary hover:text-white transition-colors">
                <i class="fas fa-image text-xl"></i>
                <span class="ml-3">Edit Banner</span>
            </a>
            <a href="{{ url('/') }}" target="_blank" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-primary hover:text-white transition-colors">
                <i class="fas fa-external-link-alt text-xl"></i>
                <span class="ml-3">Lihat Website</span>
            </a>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Berita Terbaru</h2>
        <div class="space-y-4">
            @forelse($recentNews as $news)
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-newspaper text-blue-500"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-900">{{ Str::limit($news->title, 40) }}</p>
                    <p class="text-sm text-gray-500">{{ $news->published_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            <p class="text-gray-500 text-sm">Belum ada berita</p>
            @endforelse
        </div>
    </div>

    <!-- Recent Testimonials -->
    <div class="col-span-1 lg:col-span-2 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Testimoni Terbaru</h2>
        <div class="space-y-4">
            @forelse($recentTestimonials as $testimonial)
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center">
                        <i class="fas fa-star text-yellow-500"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-900">{{ $testimonial->name }}</p>
                    <p class="text-sm text-gray-500">{{ Str::limit($testimonial->message, 100) }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $testimonial->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            <p class="text-gray-500 text-sm">Belum ada testimoni</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
