@extends('admin.layouts.app')

@section('title', 'Kelola Testimoni')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Kelola Testimoni</h1>
    <a href="{{ route('admin.testimonials.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition-colors">
        <i class="fas fa-plus mr-2"></i>Tambah Testimoni
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ulasan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($testimonials as $testimonial)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="{{ $testimonial->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($testimonial->name) }}" alt="{{ $testimonial->name }}">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $testimonial->name }}</div>
                                <div class="text-sm text-gray-500">{{ $testimonial->occupation }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ Str::limit($testimonial->content, 100) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $testimonial->rating)
                                    <i class="fas fa-star"></i>
                                @elseif($i - 0.5 <= $testimonial->rating)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="{{ route('admin.testimonials.toggle', $testimonial) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $testimonial->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} hover:opacity-75 transition-opacity">
                                {{ $testimonial->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                           class="text-primary hover:text-secondary transition-colors">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-600 hover:text-red-900 transition-colors"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Belum ada testimoni
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4">
        {{ $testimonials->links() }}
    </div>
</div>
@endsection
