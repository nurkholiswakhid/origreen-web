@extends('admin.layouts.app')

@section('title', 'Kelola Berita')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Kelola Berita</h1>
        <p class="text-gray-600 mt-1">Manajemen konten berita dan artikel</p>
    </div>
    <a href="{{ route('admin.news.create') }}" 
       class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary transition-all duration-300 transform hover:scale-105 flex items-center gap-2 shadow-lg">
        <i class="fas fa-plus"></i>
        <span>Tambah Berita</span>
    </a>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Berita</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Preview</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status & Tanggal</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach ($news as $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-start space-x-4">
                            @if($item->image_url)
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" 
                                     class="w-20 h-20 object-cover rounded-lg shadow-sm">
                            @else
                                <div class="w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-newspaper text-gray-400 text-2xl"></i>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">
                                    {{ $item->title }}
                                </p>
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ Str::limit($item->excerpt, 100) }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <button onclick="previewNews({{ json_encode($item) }})" 
                                class="text-primary hover:text-secondary transition-colors">
                            <i class="fas fa-eye mr-2"></i>Lihat Preview
                        </button>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col space-y-1">
                            @php
                                $now = now();
                                $isPublished = $item->published_at <= $now;
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $isPublished ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                <i class="fas fa-circle text-xs mr-1"></i>
                                {{ $isPublished ? 'Dipublikasi' : 'Dijadwalkan' }}
                            </span>
                            <span class="text-sm text-gray-600">
                                <i class="far fa-calendar-alt mr-2"></i>
                                {{ $item->published_at->format('d F Y') }}
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('admin.news.edit', $item) }}"
                               class="inline-flex items-center px-3 py-1.5 bg-primary text-white rounded-lg hover:bg-secondary transition-all duration-300 hover:scale-105">
                                <i class="fas fa-edit mr-2"></i>
                                <span>Edit</span>
                            </a>
                            <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all duration-300 hover:scale-105"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                    <i class="fas fa-trash-alt mr-2"></i>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
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
<!-- Preview Modal -->
<div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Preview Berita</h3>
            <button onclick="closePreviewModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
            <div id="previewContent">
                <!-- Content will be populated by JavaScript -->
            </div>
        </div>
    </div>
</div>

<script>
function previewNews(news) {
    const modal = document.getElementById('previewModal');
    const content = document.getElementById('previewContent');

    // Create preview content
    let html = `
        <div class="space-y-6">
            ${news.image_url ? `
                <img src="${news.image_url}" alt="${news.title}" 
                     class="w-full max-h-96 object-cover rounded-lg shadow-lg">
            ` : ''}
            
            <div class="space-y-4">
                <h2 class="text-2xl font-bold text-gray-800">${news.title}</h2>
                
                <div class="flex items-center space-x-4 text-sm text-gray-600">
                    <span>
                        <i class="far fa-calendar-alt mr-2"></i>
                        ${new Date(news.published_at).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        })}
                    </span>
                </div>

                <div class="prose max-w-none">
                    ${news.content}
                </div>
            </div>
        </div>
    `;

    content.innerHTML = html;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function closePreviewModal() {
    const modal = document.getElementById('previewModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
}

// Close modal when clicking outside
document.getElementById('previewModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePreviewModal();
    }
});
</script>
@endsection
