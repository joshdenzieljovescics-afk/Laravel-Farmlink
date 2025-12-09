<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FarmLink</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .farmlink-bg {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
        }
        .user-type-card {
            transition: all 0.3s ease;
        }
        .user-type-card:hover {
            transform: translateY(-4px);
        }
        .user-type-card.selected {
            border-color: #059669;
            background-color: #f0fdf4;
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
                <p class="text-xl mb-8">Join our community today!</p>
                
                <div class="bg-white/10 backdrop-blur rounded-xl p-6 mb-6">
                    <h3 class="text-2xl font-bold mb-4">🧑‍🌾 For Farmers</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center">✓ Sell your produce directly</li>
                        <li class="flex items-center">✓ Set your own prices</li>
                        <li class="flex items-center">✓ Reach more customers</li>
                    </ul>
                </div>

                <div class="bg-white/10 backdrop-blur rounded-xl p-6">
                    <h3 class="text-2xl font-bold mb-4">🛒 For Buyers</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center">✓ Fresh farm products</li>
                        <li class="flex items-center">✓ Support local farmers</li>
                        <li class="flex items-center">✓ Quality guaranteed</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="flex-1 flex items-center justify-center p-8 overflow-y-auto">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">
                    <span class="text-5xl">🌾</span>
                    <h1 class="text-3xl font-bold text-green-700 mt-2">FarmLink</h1>
                </div>

                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Create Account</h2>
                    <p class="text-gray-600 mb-6">Join FarmLink today</p>

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- User Type Selection -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-3">I am a:</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="user-type-card cursor-pointer">
                                    <input type="radio" name="user_type" value="buyer" class="hidden peer" {{ old('user_type', 'buyer') == 'buyer' ? 'checked' : '' }}>
                                    <div class="border-2 border-gray-300 rounded-lg p-4 text-center peer-checked:border-green-600 peer-checked:bg-green-50">
                                        <div class="text-4xl mb-2">🛒</div>
                                        <div class="font-semibold text-gray-800">Buyer</div>
                                        <div class="text-xs text-gray-600 mt-1">Purchase fresh produce</div>
                                    </div>
                                </label>

                                <label class="user-type-card cursor-pointer">
                                    <input type="radio" name="user_type" value="seller" class="hidden peer" {{ old('user_type') == 'seller' ? 'checked' : '' }}>
                                    <div class="border-2 border-gray-300 rounded-lg p-4 text-center peer-checked:border-green-600 peer-checked:bg-green-50">
                                        <div class="text-4xl mb-2">🧑‍🌾</div>
                                        <div class="font-semibold text-gray-800">Farmer</div>
                                        <div class="text-xs text-gray-600 mt-1">Sell your produce</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                                   placeholder="John Doe"
                                   required 
                                   autofocus>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                                   placeholder="you@example.com"
                                   required>
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

                        <!-- Confirm Password -->
                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                                   placeholder="••••••••"
                                   required>
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <!-- Terms and Privacy -->
                        <div class="mb-6">
                            <label class="flex items-start">
                                <input type="checkbox" name="terms" required class="w-4 h-4 mt-1 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                <span class="ml-2 text-sm text-gray-600">
                                    I agree to the 
                                    <a href="{{ route('terms.show') }}" target="_blank" class="text-green-600 hover:text-green-700 underline">Terms of Service</a>
                                    and 
                                    <a href="{{ route('policy.show') }}" target="_blank" class="text-green-600 hover:text-green-700 underline">Privacy Policy</a>
                                </span>
                            </label>
                        </div>
                        @endif

                        <!-- Register Button -->
                        <button type="submit" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 rounded-lg transition duration-300 transform hover:scale-[1.02]">
                            Create Account
                        </button>
                    </form>

                    <!-- Login Link -->
                    <div class="mt-6 text-center">
                        <p class="text-gray-600">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="text-green-600 hover:text-green-700 font-medium">
                                Sign in
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
