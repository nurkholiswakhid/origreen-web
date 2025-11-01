<footer class="bg-gradient-to-br from-dark to-secondary text-white pt-16 pb-8">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-4 gap-8 mb-12">
            <!-- About -->
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                        <i class="fas fa-leaf text-primary text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold">Origreen</span>
                </div>
                <p class="text-gray-300 mb-4">Destinasi wisata alam terbaik untuk pengalaman liburan yang tak terlupakan bersama keluarga.</p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary transition">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-xl font-bold mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('tentang') }}" class="text-gray-300 hover:text-primary transition">Tentang Kami</a></li>
                    <li><a href="{{ route('wahana') }}" class="text-gray-300 hover:text-primary transition">Wahana & Fasilitas</a></li>
                    <li><a href="{{ route('berita') }}" class="text-gray-300 hover:text-primary transition">Berita</a></li>
                    <li><a href="{{ url('/') }}#testimoni" class="text-gray-300 hover:text-primary transition">Testimoni</a></li>
                    <li><a href="{{ url('/') }}#faq" class="text-gray-300 hover:text-primary transition">FAQ</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-xl font-bold mb-4">Kontak</h3>
                <ul class="space-y-3 text-gray-300">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3"></i>
                        <span>Jl. Wisata Alam No. 123, Desa Hijau, Indonesia</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone mr-3"></i>
                        <span>+62 812-3456-7890</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-3"></i>
                        <span>info@origreen.com</span>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-xl font-bold mb-4">Newsletter</h3>
                <p class="text-gray-300 mb-4">Dapatkan update terbaru tentang promo dan event kami</p>
                <form class="space-y-2">
                    <input type="email" placeholder="Email Anda" class="w-full px-4 py-2 rounded-full bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:border-primary">
                    <button type="submit" class="w-full bg-primary hover:bg-secondary text-white px-6 py-2 rounded-full font-semibold transition">
                        Berlangganan
                    </button>
                </form>
            </div>
        </div>

        <div class="border-t border-white/20 pt-8 text-center text-gray-300">
            <p>&copy; {{ date('Y') }} Origreen. All rights reserved. Made with <i class="fas fa-heart text-red-500"></i> for nature lovers</p>
        </div>
    </div>
</footer>
