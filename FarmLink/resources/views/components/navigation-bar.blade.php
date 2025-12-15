<nav class="fixed w-full top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo and Navigation Links -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <span class="text-2xl">🌱</span>
                    <a href="/" class="text-xl font-bold bg-gradient-to-r from-green-600 to-green-700 bg-clip-text text-transparent">FarmLink</a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-1">
                <a href="/" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all {{ request()->is('/') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Home
                </a>
                <a href="/products" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all {{ request()->is('products') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Products
                </a>
                @auth
                    @if(Auth::user()->user_type !== 'seller')
                        <a href="{{ route('buyer.orders') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('buyer.orders') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            My Orders
                        </a>
                    @endif
                @endauth
                </div>
            </div>

            <!-- Right Side Actions -->
            <div class="hidden md:flex items-center space-x-3">
                <!-- Cart -->
                <button onclick="toggleCart()" class="relative p-2 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span id="cart-count" class="absolute -top-1 -right-1 bg-gradient-to-r from-orange-500 to-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center shadow-lg" style="display: none;">0</span>
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
                        <button onclick="toggleProfileDropdown()" class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-50 transition-all">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center text-white font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <!-- Profile Dropdown -->
                        <div id="profile-dropdown" class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 hidden z-50">
                            <div class="py-2">
                                <div class="px-4 py-2 border-b border-gray-100">
                                    <p class="text-xs text-gray-400 font-semibold uppercase">Manage Account</p>
                                </div>
                                
                                {{-- Admin Menu Items - Only Manage Products --}}
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-2 text-purple-600 hover:bg-purple-50 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                        Manage Products
                                    </a>
                                    <div class="border-t border-gray-100 my-1"></div>
                                @endif

                                {{-- Seller Menu Items - Only Manage Orders --}}
                                @if(Auth::user()->user_type === 'seller')
                                    <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-2 text-green-600 hover:bg-green-50 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Manage Orders
                                    </a>
                                    <div class="border-t border-gray-100 my-1"></div>
                                @endif
                                
                                <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Profile
                                </a>
                                @if(Auth::user()->user_type === 'seller')
                                    <div class="border-t border-gray-100 my-1"></div>
                                    @if(request()->routeIs('seller.*'))
                                        {{-- Show "View as Buyer" only when on seller pages --}}
                                        <a href="{{ route('products') }}" class="flex items-center px-4 py-2 text-green-600 hover:bg-green-50 transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            View as Buyer
                                        </a>
                                    @else
                                        {{-- Show "Back to Seller Dashboard" only when on buyer pages --}}
                                        <a href="{{ route('seller.dashboard') }}" class="flex items-center px-4 py-2 text-blue-600 hover:bg-blue-50 transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                            </svg>
                                            Back to Seller
                                        </a>
                                    @endif
                                @endif
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- User is not logged in -->
                    <a href="{{ route('login') }}" class="px-6 py-2 text-sm font-medium text-gray-700 hover:text-green-600 transition-colors">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white text-sm font-semibold rounded-lg hover:from-green-700 hover:to-green-800 transition-all shadow-md hover:shadow-lg">
                        Get Started
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center space-x-3">
                <button onclick="toggleCart()" class="relative p-2">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span id="cart-count-mobile" class="absolute -top-1 -right-1 bg-green-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
                </button>
                <button onclick="toggleMobileMenu()" class="text-gray-700 hover:text-green-600 focus:outline-none p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
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
                    <div class="pt-3 space-y-2">
                        <a href="{{ route('login') }}" class="block px-4 py-2.5 text-center text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg font-medium border border-gray-200 transition-all">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="block px-4 py-2.5 text-center bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg font-semibold hover:shadow-lg transition-all">
                            Sign Up
                        </a>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>

<script>
// Update cart count badge
window.updateCartCount = function() {
    const cartCountElement = document.getElementById('cart-count');
    const cartCountMobile = document.getElementById('cart-count-mobile');
    const cart = JSON.parse(sessionStorage.getItem('farmLinkCart')) || [];
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    
    if (cartCountElement) {
        cartCountElement.textContent = totalItems;
    }
    if (cartCountMobile) {
        cartCountMobile.textContent = totalItems;
    }
};

document.addEventListener('DOMContentLoaded', function() {
    const profileDropdown = document.getElementById('profile-dropdown');
    const mobileMenu = document.getElementById('mobile-menu');

    // Initialize cart count
    updateCartCount();

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