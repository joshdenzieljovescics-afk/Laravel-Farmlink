<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - FarmLink</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white min-h-screen">
    @include('components.navigation-bar')

    <!-- Main Content -->
    <main class="pt-16">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 text-white py-12 mb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold mb-2">My Orders</h1>
                        <p class="text-green-100">Track your purchases and order history</p>
                    </div>
                    <div class="hidden md:block">
                        <svg class="w-24 h-24 text-green-500 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            @if($orders->count() > 0)
                <!-- Orders List -->
                <div class="space-y-4">
                    @foreach($orders as $order)
                        <div class="bg-white rounded-2xl border border-gray-200 hover:border-green-300 overflow-hidden hover:shadow-lg transition-all duration-300">
                            <!-- Order Header -->
                            <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                                <div class="flex flex-wrap justify-between items-center gap-4">
                                    <div class="flex items-center gap-6">
                                        <div>
                                            <p class="text-xs text-green-100 uppercase font-semibold mb-1">Order Number</p>
                                            <p class="font-bold text-white text-lg">{{ $order->order_number }}</p>
                                        </div>
                                        <div class="hidden sm:block w-px h-12 bg-green-500"></div>
                                        <div>
                                            <p class="text-xs text-green-100 uppercase font-semibold mb-1">Date</p>
                                            <p class="font-semibold text-white">{{ $order->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="px-4 py-2 rounded-full text-sm font-bold shadow-lg
                                            @if($order->status === 'pending') bg-yellow-400 text-yellow-900
                                            @elseif($order->status === 'approved') bg-blue-400 text-blue-900
                                            @elseif($order->status === 'completed') bg-emerald-400 text-emerald-900
                                            @elseif($order->status === 'rejected') bg-red-400 text-red-900
                                            @else bg-gray-400 text-gray-900
                                            @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Content -->
                            <div class="p-6">
                                <!-- Order Items -->
                                <div class="mb-4">
                                    <h3 class="text-sm font-bold text-gray-500 uppercase mb-3">Items Ordered</h3>
                                    <div class="space-y-2">
                                        @foreach($order->items as $item)
                                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100">
                                                <div class="flex items-center gap-3">
                                                    @if($item->product && $item->product->image_path)
                                                        @php
                                                            $images = is_array($item->product->image_path) ? $item->product->image_path : [];
                                                            $firstImage = count($images) > 0 ? $images[0] : null;
                                                        @endphp
                                                        @if($firstImage)
                                                            <img src="{{ asset('storage/products/thumbnails/' . $firstImage) }}" 
                                                                 alt="{{ $item->product_name }}"
                                                                 class="w-14 h-14 object-cover rounded-lg border-2 border-white shadow-sm">
                                                        @else
                                                            <div class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center">
                                                                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center">
                                                            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <p class="font-semibold text-gray-900">{{ $item->product_name }}</p>
                                                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }} × ₱{{ number_format($item->price, 2) }}</p>
                                                    </div>
                                                </div>
                                                <p class="font-bold text-green-700">₱{{ number_format($item->subtotal, 2) }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Order Summary & Delivery -->
                                <div class="grid md:grid-cols-2 gap-4">
                                    <!-- Order Summary -->
                                    <div class="bg-green-50 rounded-xl p-4 border border-green-200">
                                        <h4 class="text-sm font-bold text-gray-700 uppercase mb-3">Order Summary</h4>
                                        <div class="space-y-2">
                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-600">Subtotal</span>
                                                <span class="font-semibold text-gray-900">₱{{ number_format($order->subtotal, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-600">Delivery Fee</span>
                                                <span class="font-semibold text-gray-900">₱{{ number_format($order->delivery_fee, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between items-center pt-2 border-t-2 border-green-300">
                                                <span class="font-bold text-gray-900">Total</span>
                                                <span class="text-xl font-bold text-green-700">₱{{ number_format($order->total, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delivery Info -->
                                    <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                                        <h4 class="text-sm font-bold text-gray-700 uppercase mb-3 flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Delivery Address
                                        </h4>
                                        <p class="text-sm text-gray-700 leading-relaxed">{{ $order->delivery_address }}</p>
                                        @if($order->delivery_notes)
                                            <div class="mt-2 pt-2 border-t border-blue-200">
                                                <p class="text-xs text-gray-500 font-semibold mb-1">Notes:</p>
                                                <p class="text-sm text-gray-700">{{ $order->delivery_notes }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                    <div class="max-w-md mx-auto">
                        <svg class="w-24 h-24 mx-auto text-green-600 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">No Orders Yet</h2>
                        <p class="text-gray-600 mb-8">You haven't placed any orders yet. Start shopping to see your order history here!</p>
                        <a href="{{ route('products') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Start Shopping
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </main>
</body>
</html>
