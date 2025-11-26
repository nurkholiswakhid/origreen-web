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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .sortable-ghost {
        opacity: 0.5 !important;
        background-color: #eff6ff !important;
    }
    .sortable-drag {
        background-color: #dbeafe !important;
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Initializing FAQ drag and drop...');
    
    const sortableContainer = document.getElementById('sortable-faqs');
    
    if (!sortableContainer) {
        console.error('Sortable container not found');
        return;
    }

    console.log('Found sortable container:', sortableContainer);

    let sortable = new Sortable(sortableContainer, {
        animation: 150,
        handle: '.cursor-move',
        ghostClass: 'sortable-ghost',
        dragClass: 'sortable-drag',
        forceFallback: false,
        direction: 'vertical',
        
        onStart: function(evt) {
            console.log('Drag started on:', evt.item.dataset.id);
        },
        
        onEnd: function(evt) {
            console.log('Drag ended');
            
            // Ambil semua items dan update urutan
            const items = [];
            const rows = document.querySelectorAll('#sortable-faqs tr[data-id]');
            console.log('Total rows:', rows.length);
            
            rows.forEach((tr, index) => {
                const id = tr.dataset.id;
                const order = index + 1;
                console.log(`Row ${index}: ID=${id}, Order=${order}`);
                items.push({
                    id: id,
                    order: order
                });
            });

            console.log('Items to send:', items);

            // Tampilkan loading dengan notif yang lebih simple
            const loadingDiv = document.createElement('div');
            loadingDiv.id = 'loading-notification';
            loadingDiv.className = 'bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 flex items-center gap-2';
            loadingDiv.innerHTML = `
                <i class="fas fa-spinner fa-spin"></i>
                <span>Menyimpan perubahan urutan...</span>
            `;
            
            const alertContainer = document.querySelector('main .p-6');
            if (alertContainer) {
                alertContainer.insertBefore(loadingDiv, alertContainer.firstChild);
            }

            // Kirim data ke server
            const reorderUrl = '{{ route('admin.faqs.reorder') }}';
            console.log('Sending to URL:', reorderUrl);
            
            fetch(reorderUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ items: items })
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                
                if (!response.ok) {
                    return response.text().then(text => {
                        console.error('Error response:', text);
                        throw new Error(`HTTP ${response.status}: ${text}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Success response:', data);
                
                if (data.success) {
                    // Update tampilan urutan di tabel
                    items.forEach(item => {
                        const tr = document.querySelector(`tr[data-id="${item.id}"]`);
                        if (tr) {
                            const orderCells = tr.querySelectorAll('td');
                            if (orderCells.length > 1) {
                                orderCells[1].innerHTML = `<span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-lg font-medium">${item.order}</span>`;
                                console.log(`Updated order for ID ${item.id} to ${item.order}`);
                            }
                        }
                    });

                    // Tampilkan notifikasi sukses yang sama seperti edit success
                    const successDiv = document.createElement('div');
                    successDiv.className = 'bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6';
                    successDiv.setAttribute('role', 'alert');
                    successDiv.innerHTML = `
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle"></i>
                            <p><strong>Berhasil!</strong> Urutan FAQ berhasil diperbarui</p>
                        </div>
                    `;
                    
                    const mainContainer = document.querySelector('main .p-6');
                    if (mainContainer) {
                        const existingAlert = mainContainer.querySelector('#loading-notification');
                        if (existingAlert) {
                            existingAlert.replaceWith(successDiv);
                        } else {
                            mainContainer.insertBefore(successDiv, mainContainer.firstChild);
                        }
                    }

                    // Auto-hide notifikasi setelah 3 detik
                    setTimeout(() => {
                        successDiv.style.transition = 'opacity 0.3s ease-out';
                        successDiv.style.opacity = '0';
                        setTimeout(() => successDiv.remove(), 300);
                    }, 3000);
                } else {
                    throw new Error(data.message || 'Gagal memperbarui urutan');
                }
            })
            .catch(error => {
                console.error('Full error:', error);
                
                // Tampilkan notifikasi error yang sama seperti error success
                const errorDiv = document.createElement('div');
                errorDiv.className = 'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6';
                errorDiv.setAttribute('role', 'alert');
                errorDiv.innerHTML = `
                    <div class="flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>
                        <p><strong>Gagal!</strong> ${error.message}</p>
                    </div>
                `;
                
                const mainContainer = document.querySelector('main .p-6');
                if (mainContainer) {
                    const existingAlert = mainContainer.querySelector('#loading-notification');
                    if (existingAlert) {
                        existingAlert.replaceWith(errorDiv);
                    } else {
                        mainContainer.insertBefore(errorDiv, mainContainer.firstChild);
                    }
                }
            });
        }
    });

    console.log('Sortable initialized');

    // Handle delete buttons
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('.delete-form');
            const question = form.getAttribute('data-question');

            Swal.fire({
                title: 'Hapus FAQ?',
                text: `Apakah Anda yakin ingin menghapus: "${question}"?`,
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
        });
    });

    // Handle search/filter
    const searchInput = document.getElementById('searchFAQ');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            document.querySelectorAll('#sortable-faqs tr[data-id]').forEach(row => {
                const questionCell = row.querySelector('td:nth-child(3)');
                if (questionCell) {
                    const isVisible = questionCell.textContent.toLowerCase().includes(searchTerm);
                    row.style.display = isVisible ? '' : 'none';
                }
            });
        });
    }
});
</script>
@endpush
