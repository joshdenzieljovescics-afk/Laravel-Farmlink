<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FarmLink</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .farmlink-bg {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Left Side - Branding -->
        <div class="hidden lg:flex lg:w-1/2 farmlink-bg items-center justify-center p-12">
            <div class="max-w-md text-white">
                <div class="flex items-center mb-8">
                    <span class="text-6xl mr-4">🌾</span>
                    <h1 class="text-5xl font-bold">FarmLink</h1>
                </div>
                <p class="text-xl mb-6">Connecting Local Farmers with Fresh Food Lovers</p>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <span class="text-3xl mr-3">🌱</span>
                        <span class="text-lg">Fresh from the farm</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-3xl mr-3">🚚</span>
                        <span class="text-lg">Direct delivery</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-3xl mr-3">🤝</span>
                        <span class="text-lg">Support local farmers</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="flex-1 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">
                    <span class="text-5xl">🌾</span>
                    <h1 class="text-3xl font-bold text-green-700 mt-2">FarmLink</h1>
                </div>

                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Welcome Back!</h2>
                    <p class="text-gray-600 mb-6">Sign in to your account</p>

                    @if (session('status'))
                        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                                   placeholder="you@example.com"
                                   required 
                                   autofocus>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                            <input type="password" 
                                   name="password" 
                                   id="password" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                                   placeholder="••••••••"
                                   required>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="remember" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                <span class="ml-2 text-sm text-gray-600">Remember me</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:text-green-700">
                                    Forgot password?
                                </a>
                            @endif
                        </div>

                        <!-- Login Button -->
                        <button type="submit" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 rounded-lg transition duration-300 transform hover:scale-[1.02]">
                            Sign In
                        </button>
                    </form>

                    <!-- Register Link -->
                    <div class="mt-6 text-center">
                        <p class="text-gray-600">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="text-green-600 hover:text-green-700 font-medium">
                                Create one now
                            </a>
                        </p>
                    </div>

                    <!-- Back to Home -->
                    <div class="mt-4 text-center">
                        <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-gray-700">
                            ← Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
