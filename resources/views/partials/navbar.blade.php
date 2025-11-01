<nav class="bg-white shadow-lg fixed w-full top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                    <i class="fas fa-leaf text-white text-xl"></i>
                </div>
                <a href="{{ url('/') }}" class="text-2xl font-bold text-primary">Origreen</a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-6">
                <a href="{{ url('/') }}#home" class="text-gray-700 hover:text-primary transition">Beranda</a>
                <a href="{{ route('tentang') }}" class="text-gray-700 hover:text-primary transition">Tentang</a>
                <a href="{{ route('wahana') }}" class="text-gray-700 hover:text-primary transition">Wahana</a>
                <a href="{{ route('berita') }}" class="text-gray-700 hover:text-primary transition">Berita</a>
                <a href="{{ url('/') }}#testimoni" class="text-gray-700 hover:text-primary transition">Testimoni</a>
                <a href="{{ url('/') }}#peta" class="text-gray-700 hover:text-primary transition">Peta</a>
                <a href="{{ url('/') }}#faq" class="text-gray-700 hover:text-primary transition">FAQ</a>
            </div>

            <!-- Mobile Menu Toggle -->
            <label for="nav-toggle" class="md:hidden cursor-pointer">
                <i class="fas fa-bars text-2xl text-gray-700"></i>
            </label>
        </div>

        <!-- Mobile Menu -->
        <input type="checkbox" id="nav-toggle" class="hidden">
        <div class="mobile-menu hidden md:hidden pb-4">
            <a href="{{ url('/') }}#home" class="block py-2 text-gray-700 hover:text-primary">Beranda</a>
            <a href="{{ route('tentang') }}" class="block py-2 text-gray-700 hover:text-primary">Tentang</a>
            <a href="{{ route('wahana') }}" class="block py-2 text-gray-700 hover:text-primary">Wahana</a>
            <a href="{{ route('berita') }}" class="block py-2 text-gray-700 hover:text-primary">Berita</a>
            <a href="{{ url('/') }}#testimoni" class="block py-2 text-gray-700 hover:text-primary">Testimoni</a>
            <a href="{{ url('/') }}#peta" class="block py-2 text-gray-700 hover:text-primary">Peta</a>
            <a href="{{ url('/') }}#faq" class="block py-2 text-gray-700 hover:text-primary">FAQ</a>
        </div>
    </div>

    <style>
        #nav-toggle:checked ~ .mobile-menu {
            display: block !important;
        }
    </style>
</nav>
