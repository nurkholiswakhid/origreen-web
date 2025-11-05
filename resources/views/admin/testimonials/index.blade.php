@extends('admin.layouts.app')

@section('title', 'Kelola Testimoni')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="animate-fade-in">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-comments text-primary"></i>
            Kelola Testimoni
        </h1>
        <p class="text-gray-600 mt-1 flex items-center gap-2">
            <span class="inline-block w-2 h-2 bg-primary rounded-full"></span>
            Manajemen ulasan dan testimonial pelanggan
        </p>
    </div>
    <a href="{{ route('admin.testimonials.create') }}"
       class="bg-primary text-white px-6 py-3 rounded-xl hover:bg-secondary transition-all duration-300 transform hover:scale-105 hover:rotate-1 flex items-center gap-3 shadow-lg group">
        <i class="fas fa-plus transform group-hover:rotate-180 transition-transform duration-300"></i>
        <span class="font-semibold">Tambah Testimoni</span>
    </a>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 transform hover:shadow-xl transition-all duration-300">
    <div class="p-4 bg-gray-50 border-b border-gray-100">
        <div class="flex items-center gap-4 flex-wrap md:flex-nowrap">
            <div class="relative flex-1">
                <input type="text"
                       id="searchInput"
                       placeholder="Cari testimoni..."
                       class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <select id="ratingFilter"
                    class="px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300 cursor-pointer">
                <option value="all">Semua Rating</option>
                <option value="5">5 Bintang</option>
                <option value="4">4 Bintang</option>
                <option value="3">3 Bintang</option>
                <option value="2">2 Bintang</option>
                <option value="1">1 Bintang</option>
            </select>
            <select id="statusFilter"
                    class="px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300 cursor-pointer">
                <option value="all">Semua Status</option>
                <option value="active">Aktif</option>
                <option value="inactive">Nonaktif</option>
            </select>
        </div>
    </div>
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
                <tr class="hover:bg-gray-50 transition-all duration-200">
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-4 hover-trigger">
                            <div class="h-12 w-12 flex-shrink-0 overflow-hidden rounded-xl hover-target">
                                <img class="h-full w-full object-cover transition-transform duration-300 transform hover:scale-110"
                                     src="{{ $testimonial->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($testimonial->name) }}"
                                     alt="{{ $testimonial->name }}">
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-900">{{ $testimonial->name }}</div>
                                <div class="text-xs text-gray-500 flex items-center gap-2">
                                    <i class="fas fa-briefcase text-primary"></i>
                                    {{ $testimonial->occupation }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900 group cursor-pointer hover:text-primary transition-colors"
                             onclick="showTestimonialContent('{{ addslashes($testimonial->content) }}', '{{ $testimonial->name }}')">
                            {{ Str::limit($testimonial->content, 100) }}
                            @if(strlen($testimonial->content) > 100)
                                <span class="text-primary text-xs ml-2 group-hover:underline">Baca selengkapnya</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-1" data-rating="{{ $testimonial->rating }}">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="transform transition-transform hover:scale-110 cursor-help
                                    {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                    title="{{ $i }} Bintang">
                                    <i class="fas fa-star"></i>
                                </span>
                            @endfor
                            <span class="ml-2 text-xs text-gray-500">({{ $testimonial->rating }}.0)</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.testimonials.toggle', $testimonial) }}"
                              method="POST"
                              class="inline-block status-toggle"
                              data-status="{{ $testimonial->is_active ? 'active' : 'inactive' }}">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                    class="px-4 py-1.5 rounded-lg text-sm font-medium transition-all duration-300 transform hover:scale-105
                                        {{ $testimonial->is_active
                                            ? 'bg-green-100 text-green-700 hover:bg-green-200'
                                            : 'bg-red-100 text-red-700 hover:bg-red-200' }}">
                                <i class="fas {{ $testimonial->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                {{ $testimonial->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                               class="p-2 text-primary hover:bg-primary hover:text-white rounded-lg transition-colors duration-300">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-2 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-colors duration-300"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
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
<!-- Testimonial Content Modal -->
<div id="testimonialModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl max-w-2xl w-full mx-4 transform transition-all duration-300 scale-95 opacity-0">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800" id="modalTitle"></h3>
            <button onclick="closeTestimonialModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-6">
            <p id="modalContent" class="text-gray-600 leading-relaxed"></p>
        </div>
    </div>
</div>

<style>
    @keyframes slideIn {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    .animate-slide-in {
        animation: slideIn 0.3s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out;
    }
    .hover-trigger .hover-target {
        transition: all 0.3s ease;
    }
    .hover-trigger:hover .hover-target {
        transform: scale(1.05);
    }
    .status-toggle button {
        position: relative;
        overflow: hidden;
    }
    .status-toggle button::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        background: currentColor;
        border-radius: inherit;
        transform: translate(-50%, -50%) scale(0);
        opacity: 0;
        transition: transform 0.3s, opacity 0.3s;
    }
    .status-toggle button:hover::after {
        transform: translate(-50%, -50%) scale(1.5);
        opacity: 0.1;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const ratingFilter = document.getElementById('ratingFilter');
    const statusFilter = document.getElementById('statusFilter');
    const tableRows = document.querySelectorAll('tbody tr');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const ratingValue = ratingFilter.value;
        const statusValue = statusFilter.value;

        tableRows.forEach(row => {
            const name = row.querySelector('.text-gray-900').textContent.toLowerCase();
            const content = row.querySelector('[onclick^="showTestimonialContent"]').textContent.toLowerCase();
            const rating = row.querySelector('[data-rating]')?.dataset.rating;
            const status = row.querySelector('.status-toggle')?.dataset.status;

            const matchesSearch = name.includes(searchTerm) || content.includes(searchTerm);
            const matchesRating = ratingValue === 'all' || rating === ratingValue;
            const matchesStatus = statusValue === 'all' || status === statusValue;

            if (matchesSearch && matchesRating && matchesStatus) {
                row.style.display = '';
                row.classList.add('animate-fade-in');
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Add input event listeners
    searchInput.addEventListener('input', filterTable);
    ratingFilter.addEventListener('change', filterTable);
    statusFilter.addEventListener('change', filterTable);

    // Add hover effects for rating stars
    document.querySelectorAll('[data-rating]').forEach(container => {
        const stars = container.querySelectorAll('.fa-star');
        stars.forEach((star, index) => {
            star.addEventListener('mouseenter', () => {
                for (let i = 0; i <= index; i++) {
                    stars[i].classList.add('text-yellow-500');
                }
            });
            star.addEventListener('mouseleave', () => {
                const rating = parseInt(container.dataset.rating);
                stars.forEach((s, i) => {
                    s.classList.toggle('text-yellow-400', i < rating);
                    s.classList.toggle('text-gray-300', i >= rating);
                });
            });
        });
    });
});

function showTestimonialModal(content) {
    const modal = document.getElementById('testimonialModal');
    const modalContent = modal.querySelector('.bg-white');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    // Trigger reflow
    void modalContent.offsetWidth;

    modalContent.classList.remove('scale-95', 'opacity-0');
    modalContent.classList.add('scale-100', 'opacity-100');

    document.body.classList.add('overflow-hidden');
}

function closeTestimonialModal() {
    const modal = document.getElementById('testimonialModal');
    const modalContent = modal.querySelector('.bg-white');

    modalContent.classList.add('scale-95', 'opacity-0');
    modalContent.classList.remove('scale-100', 'opacity-100');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }, 200);
}

function showTestimonialContent(content, name) {
    const modalTitle = document.getElementById('modalTitle');
    const modalContent = document.getElementById('modalContent');

    modalTitle.textContent = `Testimonial dari ${name}`;
    modalContent.textContent = content;

    showTestimonialModal();
}

// Close modal when clicking outside
document.getElementById('testimonialModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeTestimonialModal();
    }
});
</script>
@endsection
