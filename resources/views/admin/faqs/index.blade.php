@extends('admin.layouts.app')

@section('title', 'Daftar FAQ')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Daftar FAQ</h1>
    <a href="{{ route('admin.faqs.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition">
        <i class="fas fa-plus mr-2"></i>Tambah FAQ
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="text-left font-bold bg-gray-50">
                        <th class="px-6 py-3">Order</th>
                        <th class="px-6 py-3">Pertanyaan</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($faqs as $faq)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $faq->order }}</td>
                            <td class="px-6 py-4">{{ $faq->question }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.faqs.toggle', $faq) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="px-3 py-1 rounded-full text-sm {{ $faq->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $faq->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.faqs.edit', $faq) }}" class="text-blue-500 hover:text-blue-700 mr-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                Belum ada FAQ.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
