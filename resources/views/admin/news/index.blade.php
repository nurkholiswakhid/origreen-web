@extends('admin.layouts.app')

@section('title', 'Kelola Berita')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Kelola Berita</h1>
    <a href="{{ route('admin.news.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition-colors">
        <i class="fas fa-plus mr-2"></i>Tambah Berita
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Excerpt</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Publikasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($news as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->title }}</td>
                    <td class="px-6 py-4">{{ Str::limit($item->excerpt, 100) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <i class="{{ $item->icon }} mr-2"></i>{{ $item->icon }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->published_at->format('d F Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap space-x-2">
                        <a href="{{ route('admin.news.edit', $item) }}"
                           class="inline-flex items-center px-3 py-1 bg-primary text-white rounded hover:bg-secondary transition-colors">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition-colors"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4">
        {{ $news->links() }}
    </div>
</div>
@endsection
