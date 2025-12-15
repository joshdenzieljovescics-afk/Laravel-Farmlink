<nav x-data="{ open: false }" class="fixed w-full top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-200 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo and Navigation Links -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="@if(Auth::user() && Auth::user()->user_type === 'seller'){{ route('seller.dashboard') }}@else{{ route('dashboard') }}@endif" class="flex items-center space-x-2">
                        <x-application-mark class="block" />
                        <span class="text-xl font-bold bg-gradient-to-r from-green-600 to-green-700 bg-clip-text text-transparent hidden sm:block">FarmLink</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:flex items-center">
                    @if(Auth::user() && Auth::user()->user_type === 'seller')
                        <!-- Seller Navigation -->
                        <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('home') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Home
                        </a>
                        <a href="{{ route('seller.dashboard') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('seller.dashboard') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            My Products
                        </a>
                        <a href="{{ route('seller.products.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('seller.products.create') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add Product
                        </a>
                    @else
                        <!-- Buyer Navigation -->
                        <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('home') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Home
                        </a>
                        <a href="{{ route('products') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('products') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Products
                        </a>
                        <a href="{{ route('buyer.orders') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('buyer.orders') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            My Orders
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right Side Actions -->
            <div class="hidden sm:flex sm:items-center space-x-3">
                <!-- Cart Button (Only for Buyers) -->
                @if(Auth::user() && Auth::user()->user_type !== 'seller')
                    <a href="{{ route('products') }}" class="relative p-2 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span id="cart-count" class="absolute -top-1 -right-1 bg-gradient-to-r from-orange-500 to-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center shadow-lg" style="display: none;">0</span>
                    </a>
                @endif

                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50 transition-all">
                                    {{ Auth::user()->currentTeam->name }}
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <div class="block px-4 py-2 text-xs text-gray-400 font-semibold uppercase">
                                        Manage Team
                                    </div>

                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        Team Settings
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            Create New Team
                                        </x-dropdown-link>
                                    @endcan

                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200"></div>
                                        <div class="block px-4 py-2 text-xs text-gray-400 font-semibold uppercase">
                                            Switch Teams
                                        </div>
                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-50 transition-all">
                                    <img class="w-8 h-8 rounded-full object-cover ring-2 ring-green-500" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    <span class="text-sm font-medium text-gray-700 hidden md:block">{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            @else
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50 transition-all">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center text-white font-bold mr-2">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span class="hidden md:block">{{ Auth::user()->name }}</span>
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400 font-semibold uppercase">
                                Manage Account
                            </div>

                            {{-- Seller Menu Items - Only Manage Orders --}}
                            @if(Auth::user() && Auth::user()->user_type === 'seller')
                                <x-dropdown-link href="{{ route('admin.orders.index') }}">
                                    <div class="flex items-center text-green-600">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Manage Orders
                                    </div>
                                </x-dropdown-link>
                                <div class="border-t border-gray-200 my-1"></div>
                            @endif

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Profile
                                </div>
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                        </svg>
                                        API Tokens
                                    </div>
                                </x-dropdown-link>
                            @endif

                            @if(Auth::user() && Auth::user()->user_type === 'seller')
                                <div class="border-t border-gray-200 my-1"></div>
                                @if(request()->routeIs('seller.*'))
                                    {{-- Show "View as Buyer" only when on seller pages --}}
                                    <x-dropdown-link href="{{ route('products') }}">
                                        <div class="flex items-center text-green-600">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            View as Buyer
                                        </div>
                                    </x-dropdown-link>
                                @else
                                    {{-- Show "Back to Seller Dashboard" only when on buyer pages --}}
                                    <x-dropdown-link href="{{ route('seller.dashboard') }}">
                                        <div class="flex items-center text-blue-600">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                            </svg>
                                            Back to Seller
                                        </div>
                                    </x-dropdown-link>
                                @endif
                            @endif

                            <div class="border-t border-gray-200 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    <div class="flex items-center text-red-600">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Log Out
                                    </div>
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1 px-2">
            @if(Auth::user() && Auth::user()->user_type === 'seller')
                <!-- Seller Mobile Navigation -->
                <a href="{{ route('seller.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('seller.dashboard') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    My Products
                </a>
                <a href="{{ route('seller.products.create') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('seller.products.create') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Product
                </a>
            @else
                <!-- Buyer Mobile Navigation -->
                <a href="{{ route('products') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('products') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Products
                </a>
                <a href="{{ route('buyer.orders') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('buyer.orders') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    My Orders
                </a>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>

<script>
    // Initialize cart count on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateCartCount();
    });

    // Update cart count function
    function updateCartCount() {
        try {
            const cart = JSON.parse(sessionStorage.getItem('farmLinkCart')) || [];
            const cartCount = cart.reduce((total, item) => total + item.quantity, 0);
            const cartCountElement = document.getElementById('cart-count');
            if (cartCountElement) {
                cartCountElement.textContent = cartCount;
                cartCountElement.style.display = cartCount > 0 ? 'flex' : 'none';
            }
        } catch (error) {
            console.error('Error updating cart count:', error);
        }
    }

    // Listen for storage changes to update cart count
    window.addEventListener('storage', function(e) {
        if (e.key === 'farmLinkCart') {
            updateCartCount();
        }
    });
</script>