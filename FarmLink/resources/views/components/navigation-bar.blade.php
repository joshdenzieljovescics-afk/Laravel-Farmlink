<nav class="bg-white shadow-lg relative z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <span class="text-2xl">🌱</span>
                <a href="/" class="text-2xl font-bold text-green-600">FarmLink</a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="/products" class="text-gray-600 hover:text-green-600 transition duration-300">Products</a>
                <a href="/about" class="text-gray-600 hover:text-green-600 transition duration-300">About</a>
                <a href="/contact" class="text-gray-600 hover:text-green-600 transition duration-300">Contact</a>
                <a href="/developers" class="text-gray-600 hover:text-green-600 transition duration-300">Developers</a>
                
                <!-- Cart -->
                <button onclick="toggleCart()" class="relative p-2 text-gray-600 hover:text-green-600 transition duration-300">
                    <span class="text-2xl">🛒</span>
                    <span id="cart-count" class="absolute -top-1 -right-1 bg-green-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
                </button>

                <!-- User Authentication -->
                @auth
                    <!-- FarmTokens Display -->
                    <a href="{{ route('topup') }}" class="flex items-center space-x-2 bg-green-50 hover:bg-green-100 px-4 py-2 rounded-lg transition duration-300 border border-green-200">
                        <span class="text-xl">🪙</span>
                        <span class="font-semibold text-green-600">{{ number_format(Auth::user()->farm_tokens ?? 0) }}</span>
                        <span class="text-sm text-gray-600">FT</span>
                    </a>

                    <!-- User is logged in -->
                    <div class="relative">
                        <button onclick="toggleProfileDropdown()" class="flex items-center space-x-2 text-gray-600 hover:text-green-600 transition duration-300">
                            <span class="text-xl">👤</span>
                            <span>{{ Auth::user()->name }}</span>
                            <span class="text-sm">▼</span>
                        </button>
                        
                        <!-- Profile Dropdown -->
                        <div id="profile-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border hidden z-50">
                            <div class="py-2">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Dashboard</a>
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-green-600 hover:bg-gray-100">Admin Dashboard</a>
                                    <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 text-green-600 hover:bg-gray-100">Manage Products</a>
                                    <a href="{{ route('admin.users') }}" class="block px-4 py-2 text-green-600 hover:bg-gray-100">Manage Users</a>
                                @endif
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Orders</a>
                                <div class="border-t my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- User is not logged in -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-green-600 transition duration-300">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                            Sign Up
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button onclick="toggleMobileMenu()" class="text-gray-600 hover:text-green-600 focus:outline-none">
                    <span class="text-2xl">☰</span>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 border-t">
                @auth
                    <!-- Mobile FarmTokens Display -->
                    <a href="{{ route('topup') }}" class="flex items-center justify-between bg-green-50 hover:bg-green-100 px-3 py-2 rounded-lg mb-2">
                        <span class="flex items-center space-x-2">
                            <span class="text-xl">🪙</span>
                            <span class="text-gray-600">FarmTokens</span>
                        </span>
                        <span class="font-bold text-green-600">{{ number_format(Auth::user()->farm_tokens ?? 0) }} FT</span>
                    </a>
                @endauth
                
                <a href="#products" class="block px-3 py-2 text-gray-600 hover:text-green-600">Products</a>
                <a href="#about" class="block px-3 py-2 text-gray-600 hover:text-green-600">About</a>
                <a href="#contact" class="block px-3 py-2 text-gray-600 hover:text-green-600">Contact</a>
                <a href="/developers" class="block px-3 py-2 text-gray-600 hover:text-green-600">Developers</a>
                @guest
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-gray-600 hover:text-green-600">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="block w-full text-left px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 mt-2">
                        Sign Up
                    </a>
                @endguest
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileDropdown = document.getElementById('profile-dropdown');
    const mobileMenu = document.getElementById('mobile-menu');

    // Toggle mobile menu
    window.toggleMobileMenu = function() {
        mobileMenu.classList.toggle('hidden');
    };

    // Toggle profile dropdown
    window.toggleProfileDropdown = function() {
        profileDropdown.classList.toggle('hidden');
    };

    // Close profile dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (profileDropdown && !event.target.closest('.relative')) {
            profileDropdown.classList.add('hidden');
        }
    });
});
</script>