<!-- Navbar -->
<nav class="bg-white shadow-md fixed w-full z-30">
    <div class="px-4 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <!-- Mobile menu button -->
                <button onclick="toggleSidebar()" class="text-gray-500 hover:text-gray-700 lg:hidden">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-primary ml-4">
                    Origreen Admin
                </a>
            </div>
            <div class="flex items-center">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="Profile" class="w-8 h-8 rounded-full">
                        <span class="hidden md:inline">{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down text-sm"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
