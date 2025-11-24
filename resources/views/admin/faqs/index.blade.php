@extends('admin.layouts.app')

@section('title', 'Daftar FAQ')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="flex items-center gap-3">
        <div class="bg-primary bg-opacity-10 p-2 rounded-lg">
            <i class="fas fa-question-circle text-2xl text-primary"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar FAQ</h1>
            <p class="text-gray-600 text-sm">Kelola pertanyaan yang sering ditanyakan</p>
        </div>
    </div>
    <a href="{{ route('admin.faqs.create') }}"
       class="bg-primary text-white px-6 py-2 rounded-xl hover:bg-secondary transition-all duration-300 transform hover:scale-105 hover:rotate-1 flex items-center gap-3 shadow-lg group">
        <i class="fas fa-plus transform group-hover:rotate-180 transition-transform duration-300"></i>
        <span>Tambah FAQ</span>
    </a>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
    <div class="border-b border-gray-100 bg-gray-50 px-6 py-4">
        <div class="flex items-center justify-between">
            <h2 class="font-medium text-gray-700 flex items-center gap-2">
                <i class="fas fa-list text-primary"></i>
                Daftar Pertanyaan
            </h2>
            <div class="relative">
                <input type="text"
                       id="searchFAQ"
                       placeholder="Cari FAQ..."
                       class="w-64 pl-10 pr-4 py-2 rounded-lg border-2 border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>
    </div>
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr>
                        <th class="w-14"></th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pertanyaan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="sortable-faqs">
                    @forelse($faqs as $faq)
                        <tr class="hover:bg-gray-50 transition-colors duration-200" data-id="{{ $faq->id }}">
                            <td class="w-14 px-4">
                                <div class="cursor-move text-gray-400 hover:text-gray-600 transition-colors duration-200 flex items-center justify-center">
                                    <i class="fas fa-grip-vertical text-lg"></i>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-lg font-medium">{{ $faq->order }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-800">{{ $faq->question }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.faqs.toggle', $faq) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                            class="px-4 py-1.5 rounded-lg text-sm font-medium transition-all duration-300
                                            {{ $faq->is_active
                                                ? 'bg-green-50 text-green-600 hover:bg-green-100 border-2 border-green-200'
                                                : 'bg-red-50 text-red-600 hover:bg-red-100 border-2 border-red-200'
                                            }}">
                                        <i class="fas {{ $faq->is_active ? 'fa-check' : 'fa-times' }} mr-1.5"></i>
                                        {{ $faq->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.faqs.edit', $faq) }}"
                                       class="bg-blue-50 text-blue-600 p-2 rounded-lg hover:bg-blue-100 transition-all duration-300 border-2 border-blue-200 group">
                                        <i class="fas fa-edit transform group-hover:scale-110 transition-transform"></i>
                                    </a>
                                    <form action="{{ route('admin.faqs.destroy', $faq) }}"
                                          method="POST"
                                          class="inline delete-form"
                                          data-question="{{ $faq->question }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                class="bg-red-50 text-red-600 p-2 rounded-lg hover:bg-red-100 transition-all duration-300 border-2 border-red-200 group delete-btn">
                                            <i class="fas fa-trash transform group-hover:scale-110 transition-transform"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <div class="bg-gray-100 p-4 rounded-full">
                                        <i class="fas fa-question-circle text-4xl text-gray-400"></i>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-gray-500 mb-2">Belum ada FAQ yang ditambahkan</p>
                                        <a href="{{ route('admin.faqs.create') }}"
                                           class="text-primary hover:text-secondary transition-colors duration-300">
                                            Tambah FAQ Sekarang
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var el = document.getElementById('sortable-faqs');
    var sortable = new Sortable(el, {
        animation: 150,
        handle: '.cursor-move',
        ghostClass: 'bg-gray-100',
        onEnd: function(evt) {
            const items = [...evt.to.children].map((tr, index) => ({
                id: tr.dataset.id,
                order: index + 1
            }));

            // Perbarui tampilan urutan
            items.forEach(item => {
                const tr = document.querySelector(`tr[data-id="${item.id}"]`);
                const orderSpan = tr.querySelector('td:nth-child(2) span');
                orderSpan.textContent = item.order;
            });

            // Kirim data ke server
            fetch('{{ route('admin.faqs.reorder') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ items })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Urutan FAQ berhasil diperbarui',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat memperbarui urutan'
                });
            });
        }
    });

    // Handle delete buttons
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('.delete-form');
            const question = form.getAttribute('data-question');

            Swal.fire({
                title: 'Hapus FAQ?',
                text: `Apakah Anda yakin ingin menghapus FAQ ini?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
});
</script>
@endpush
