<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Origreen Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#10b981',
                        secondary: '#059669',
                        dark: '#064e3b',
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
    </style>

    {{-- Tambahkan ini agar halaman lain bisa menambah CSS seperti Summernote --}}
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: false }">
        @include('admin.layouts.partials.nav')

        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 bg-white shadow-lg lg:w-64 w-3/4 transition-transform duration-300 transform lg:translate-x-0 z-20"
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
            <div class="flex flex-col h-full">
                <!-- Sidebar Header -->
                <div class="h-16"></div>

                <!-- Sidebar Content -->
                <nav class="flex-1 px-4 py-4 space-y-2">
                    @include('admin.layouts.sidebar')
                </nav>

                <!-- Sidebar Footer -->
                <div class="p-4 border-t">
                    <div class="flex items-center space-x-4">
                        <a href="{{ url('/') }}" target="_blank" class="flex items-center text-sm text-gray-600 hover:text-primary">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            Lihat Website
                        </a>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black opacity-50 z-10 lg:hidden"></div>

        <!-- Main Content -->
        <main class="lg:ml-64 pt-16">
            <div class="p-6">
                @include('admin.layouts.partials.alerts')
                @yield('content')
            </div>
        </main>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- Tambahkan ini agar halaman bisa menambah JS seperti Summernote --}}
    @stack('scripts')
</body>
</html>
