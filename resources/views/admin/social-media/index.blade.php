@extends('admin.layouts.app')

@section('title', 'Social Media')

@push('styles')
<style>
    .sortable-ghost {
        background-color: #f3f4f6 !important;
        border: 2px dashed #d1d5db !important;
        opacity: 0.8;
    }
    .sortable-drag {
        background-color: #ffffff !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .sortable-handle {
        cursor: move;
    }
    .sortable-handle:hover {
        color: #4f46e5;
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <div class="animate-fade-in">
            <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                <span class="bg-primary/10 p-2 rounded-lg">
                    <i class="fas fa-share-alt text-primary text-2xl"></i>
                </span>
                Kelola Social Media
            </h1>
        </div>
        <a href="{{ route('admin.social-media.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 border border-primary bg-white text-primary rounded-lg hover:bg-primary hover:text-white transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
            <i class="fas fa-plus text-sm"></i>
            <span class="font-medium">Tambah Social Media</span>
        </a>
    </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-globe text-primary"></i>
                                        Platform
                                    </div>
                                </th>
                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-link text-primary"></i>
                                        URL
                                    </div>
                                </th>
                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-icons text-primary"></i>
                                        Icon
                                    </div>
                                </th>
                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-toggle-on text-primary"></i>
                                        Status
                                    </div>
                                </th>
                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-sort-numeric-down text-primary"></i>
                                        Urutan
                                    </div>
                                </th>
                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-cog text-primary"></i>
                                        Aksi
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($socialMedia as $social)
                                <tr class="hover:bg-gray-50 transition duration-150" data-id="{{ $social->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <span class="sortable-handle text-gray-400 hover:text-primary transition-colors">
                                                <i class="fas fa-grip-vertical"></i>
                                            </span>
                                            <div class="text-sm font-medium text-gray-900">{{ $social->platform }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ $social->url }}" target="_blank"
                                           class="text-primary hover:text-primary-dark flex items-center gap-2 group">
                                            <span class="text-sm">{{ $social->url }}</span>
                                            <i class="fas fa-external-link-alt text-xs opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <span class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-lg">
                                                <i class="{{ $social->icon }} text-lg text-primary"></i>
                                            </span>
                                            <span class="text-gray-500 text-xs font-mono">{{ $social->icon }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('admin.social-media.toggle', ['socialMedia' => $social->id]) }}" method="POST" class="inline toggle-status-form" data-id="{{ $social->id }}">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium cursor-pointer transition-all duration-300 hover:shadow-md
                                                {{ $social->is_active
                                                    ? 'bg-green-100 text-green-800 border border-green-200 hover:bg-green-200'
                                                    : 'bg-red-100 text-red-800 border border-red-200 hover:bg-red-200' }}">
                                                <i class="fas {{ $social->is_active ? 'fa-check' : 'fa-times' }} mr-1"></i>
                                                {{ $social->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 rounded-lg text-sm font-medium sort-order">
                                            {{ $social->sort_order }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('admin.social-media.edit', ['socialMedia' => $social->id]) }}"
                                               class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.social-media.destroy', ['socialMedia' => $social->id]) }}"
                                                method="POST" class="inline-block delete-form"
                                                data-name="{{ $social->name }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors delete-btn">
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
        </div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tbody = document.querySelector('tbody');
    let isDragging = false;

    new Sortable(tbody, {
        handle: '.sortable-handle',
        animation: 150,
        onStart: function() {
            isDragging = true;
        },
        onEnd: function(evt) {
            isDragging = false;
            if (evt.oldIndex === evt.newIndex) return;

            const rows = Array.from(tbody.querySelectorAll('tr'));
            const newOrder = rows.map((row, index) => ({
                id: row.dataset.id,
                order: index + 1
            }));

            // Update visual order numbers immediately
            rows.forEach((row, index) => {
                row.querySelector('.sort-order').textContent = index + 1;
            });

            // Tampilkan loading notification
            const loadingDiv = document.createElement('div');
            loadingDiv.id = 'loading-notification';
            loadingDiv.className = 'bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 flex items-center gap-2';
            loadingDiv.innerHTML = `
                <i class="fas fa-spinner fa-spin"></i>
                <span>Menyimpan perubahan urutan...</span>
            `;
            
            const alertContainer = document.querySelector('main .p-6, .bg-white.rounded-lg');
            if (alertContainer) {
                alertContainer.insertBefore(loadingDiv, alertContainer.firstChild);
            }

            // Send to server
            fetch('{{ route('admin.social-media.reorder') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ items: newOrder })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success notification seperti alert box
                    const successDiv = document.createElement('div');
                    successDiv.className = 'bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6';
                    successDiv.setAttribute('role', 'alert');
                    successDiv.innerHTML = `
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle"></i>
                            <p><strong>Berhasil!</strong> Urutan social media berhasil diperbarui</p>
                        </div>
                    `;
                    
                    const container = document.querySelector('main .p-6, .bg-white.rounded-lg');
                    if (container) {
                        const existingAlert = container.querySelector('#loading-notification');
                        if (existingAlert) {
                            existingAlert.replaceWith(successDiv);
                        } else {
                            container.insertBefore(successDiv, container.firstChild);
                        }
                    }

                    // Auto-hide notifikasi setelah 3 detik
                    setTimeout(() => {
                        successDiv.style.transition = 'opacity 0.3s ease-out';
                        successDiv.style.opacity = '0';
                        setTimeout(() => successDiv.remove(), 300);
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Show error notification seperti alert box
                const errorDiv = document.createElement('div');
                errorDiv.className = 'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6';
                errorDiv.setAttribute('role', 'alert');
                errorDiv.innerHTML = `
                    <div class="flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>
                        <p><strong>Gagal!</strong> Terjadi kesalahan saat memperbarui urutan</p>
                    </div>
                `;
                
                const container = document.querySelector('main .p-6, .bg-white.rounded-lg');
                if (container) {
                    const existingAlert = container.querySelector('#loading-notification');
                    if (existingAlert) {
                        existingAlert.replaceWith(errorDiv);
                    } else {
                        container.insertBefore(errorDiv, container.firstChild);
                    }
                }
            });
        }
    });

    // Handle delete buttons with event delegation
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-btn')) {
            e.preventDefault();
            const button = e.target.closest('.delete-btn');
            const form = button.closest('.delete-form');
            const name = form.getAttribute('data-name');

            Swal.fire({
                title: 'Hapus Social Media?',
                text: `Apakah Anda yakin ingin menghapus "${name}"?`,
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

    // Handle toggle status dengan AJAX
    document.querySelectorAll('.toggle-status-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const socialMediaId = this.getAttribute('data-id');
            const button = this.querySelector('button');
            const currentStatus = button.classList.contains('bg-green-100');
            const formAction = this.action;
            
            // Disable button saat loading
            button.disabled = true;
            const originalHtml = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengubah...';

            fetch(formAction, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    return response.text().then(text => {
                        console.error('Error response:', text);
                        throw new Error(`HTTP ${response.status}: ${text}`);
                    });
                }
                // Handle berbagai tipe response
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    // Jika response bukan JSON tapi status 200, anggap sukses
                    return { success: true };
                }
            })
            .then(data => {
                console.log('Response data:', data);
                
                // Update tampilan button
                const newStatus = !currentStatus;
                if (newStatus) {
                    // Ubah ke Aktif
                    button.classList.remove('bg-red-100', 'text-red-800', 'border-red-200', 'hover:bg-red-200');
                    button.classList.add('bg-green-100', 'text-green-800', 'border-green-200', 'hover:bg-green-200');
                    button.innerHTML = '<i class="fas fa-check mr-1"></i>Aktif';
                } else {
                    // Ubah ke Tidak Aktif
                    button.classList.remove('bg-green-100', 'text-green-800', 'border-green-200', 'hover:bg-green-200');
                    button.classList.add('bg-red-100', 'text-red-800', 'border-red-200', 'hover:bg-red-200');
                    button.innerHTML = '<i class="fas fa-times mr-1"></i>Tidak Aktif';
                }

                // Tampilkan notifikasi sukses
                const successDiv = document.createElement('div');
                successDiv.className = 'bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6';
                successDiv.setAttribute('role', 'alert');
                successDiv.innerHTML = `
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <p><strong>Berhasil!</strong> Status social media berhasil diperbarui</p>
                    </div>
                `;
                
                const container = document.querySelector('main .p-6') || document.querySelector('.bg-white.rounded-lg');
                if (container) {
                    container.insertBefore(successDiv, container.firstChild);
                    
                    // Auto-hide notifikasi setelah 3 detik
                    setTimeout(() => {
                        successDiv.style.transition = 'opacity 0.3s ease-out';
                        successDiv.style.opacity = '0';
                        setTimeout(() => successDiv.remove(), 300);
                    }, 3000);
                }

                button.disabled = false;
            })
            .catch(error => {
                console.error('Full error:', error);
                button.disabled = false;
                button.innerHTML = originalHtml;
                
                // Tampilkan notifikasi error
                const errorDiv = document.createElement('div');
                errorDiv.className = 'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6';
                errorDiv.setAttribute('role', 'alert');
                errorDiv.innerHTML = `
                    <div class="flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>
                        <p><strong>Gagal!</strong> ${error.message}</p>
                    </div>
                `;
                
                const container = document.querySelector('main .p-6') || document.querySelector('.bg-white.rounded-lg');
                if (container) {
                    container.insertBefore(errorDiv, container.firstChild);
                }
            });
        });
    });

    // Add tooltips for drag handle
    const handles = document.querySelectorAll('.sortable-handle');
    handles.forEach(handle => {
        handle.title = 'Geser untuk mengubah urutan';
    });
});
</script>
@endpush

@endsection
