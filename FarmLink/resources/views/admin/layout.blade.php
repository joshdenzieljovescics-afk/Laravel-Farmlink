<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - FarmLink</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'admin-primary': '#1f2937',
                        'admin-secondary': '#374151',
                        'admin-accent': '#10b981'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100">
    <!-- Admin Navigation -->
    <nav class="bg-admin-primary text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <h1 class="text-xl font-bold">🌱 FarmLink Admin</h1>
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-admin-accent transition duration-300">Dashboard</a>
                        <div class="relative group">
                            <a href="{{ route('admin.products.index') }}" class="hover:text-admin-accent transition duration-300 flex items-center">
                                Products
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </a>
                            <div class="absolute top-full left-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <div class="py-1">
                                    <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">All Products</a>
                                    <a href="{{ route('admin.products.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Add Product</a>
                                    <a href="{{ route('admin.products.archived') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Archived Products</a>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.users') }}" class="hover:text-admin-accent transition duration-300">Users</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-sm hover:text-admin-accent transition duration-300">
                        View Site
                    </a>
                    <span class="text-sm">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm hover:text-red-400 transition duration-300">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>