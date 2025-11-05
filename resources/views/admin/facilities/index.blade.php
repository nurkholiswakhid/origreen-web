@extends('admin.layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Daftar Wahana & Fasilitas</h1>
        <p class="text-sm text-gray-600 mt-1">Kelola semua wahana dan fasilitas yang tersedia</p>
    </div>
    <a href="{{ route('admin.facilities.create') }}"
        class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition-colors flex items-center group">
        <i class="fas fa-plus mr-2 group-hover:scale-110 transition-transform"></i>
        Tambah Baru
    </a>
</div>



<div class="bg-white rounded-xl shadow-lg border border-gray-100">
    <div class="border-b border-gray-100 bg-gray-50 px-6 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center text-gray-600">
                <i class="fas fa-list text-primary mr-2"></i>
                <span>Data Wahana & Fasilitas</span>
            </div>
            <div class="text-gray-500 text-sm">
                Total: {{ $facilities->count() }} item
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-sm font-medium text-gray-600">Urutan</th>
                    <th class="px-6 py-4 text-sm font-medium text-gray-600">Tampilan</th>
                    <th class="px-6 py-4 text-sm font-medium text-gray-600">Nama & Deskripsi</th>
                    <th class="px-6 py-4 text-sm font-medium text-gray-600">Kategori</th>
                    <th class="px-6 py-4 text-sm font-medium text-gray-600">Durasi/Info</th>
                    <th class="px-6 py-4 text-sm font-medium text-gray-600">Status</th>
                    <th class="px-6 py-4 text-right text-sm font-medium text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($facilities as $facility)
                    <tr class="{{ !$facility->is_active ? 'bg-gray-50' : '' }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="flex items-center space-x-2">
                                <span class="w-8 text-center">{{ $facility->order }}</span>
                                <div class="flex flex-col space-y-1">
                                    <form action="{{ route('admin.facilities.move', ['facility' => $facility->id, 'direction' => 'up']) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-gray-400 hover:text-gray-600 disabled:opacity-50 disabled:cursor-not-allowed" {{ $loop->first ? 'disabled' : '' }}>
                                            <i class="fas fa-chevron-up text-xs"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.facilities.move', ['facility' => $facility->id, 'direction' => 'down']) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-gray-400 hover:text-gray-600 disabled:opacity-50 disabled:cursor-not-allowed" {{ $loop->last ? 'disabled' : '' }}>
                                            <i class="fas fa-chevron-down text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col items-center gap-2">
                                @if($facility->display_type === 'icon')
                                    @if($facility->main_icon)
                                        <i class="{{ $facility->main_icon }} text-2xl text-primary"></i>
                                    @endif
                                @else
                                    @if($facility->image_url)
                                        <img src="{{ Storage::url($facility->image_url) }}"
                                             alt="{{ $facility->name }}"
                                             class="h-12 w-12 object-cover rounded shadow-sm border border-gray-200">
                                    @else
                                        <div class="h-12 w-12 rounded bg-gray-100 flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                @endif
                                <span class="text-xs text-gray-500">{{ ucfirst($facility->display_type) }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $facility->name }}</div>
                            <div class="text-sm text-gray-500 max-w-md">{{ Str::limit($facility->description, 100) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $facility->type === 'wahana' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                {{ ucfirst($facility->type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col gap-2">
                                @if($facility->icon)
                                    <div class="flex items-center gap-2">
                                        <i class="{{ $facility->icon }} text-lg text-gray-600"></i>
                                        <span class="text-xs text-gray-500">
                                            @if($facility->type === 'wahana')
                                                <span class="flex items-center gap-1">
                                                    <i ></i>
                                                    <span>{{ $facility->duration ?: '-' }}</span>
                                                </span>
                                            @else
                                                <span class="flex items-center gap-1">
                                                    <i></i>
                                                    <span>{{ $facility->duration ?: 'Tersedia' }}</span>
                                                </span>
                                            @endif
                                        </span>
                                    </div>
                                @endif

                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.facilities.toggle', $facility) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="px-3 py-1 inline-flex items-center gap-1 text-xs leading-5 font-semibold rounded-full transition-colors
                                    {{ $facility->is_active
                                        ? 'bg-green-100 text-green-800 hover:bg-green-200'
                                        : 'bg-red-100 text-red-800 hover:bg-red-200' }}">
                                    <i class="fas fa-{{ $facility->is_active ? 'check' : 'times' }} text-xs"></i>
                                    {{ $facility->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-3">
                                <a href="{{ route('admin.facilities.edit', $facility) }}"
                                   class="text-primary hover:text-secondary transition-colors"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.facilities.destroy', $facility) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 transition-colors"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus {{ $facility->name }}?')"
                                        title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
