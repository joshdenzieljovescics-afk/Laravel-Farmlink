@extends('admin.layout')

@section('title', 'Archived Products')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div class="flex items-center">
        <a href="{{ route('admin.products.index') }}" 
           class="text-gray-600 hover:text-gray-800 mr-4">
            ← Back to Products
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Archived Products</h1>
    </div>
</div>

<!-- Archived Products Stats -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                🗃️
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-700">Archived Products</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $products->total() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                ♻️
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-700">Available to Restore</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $products->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Archived Products Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">Archived Products</h2>
        <p class="text-gray-600 text-sm mt-1">Products that have been archived (soft deleted). You can restore or permanently delete them.</p>
    </div>
    
    @if($products->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Archived Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($products as $product)
                        <tr class="hover:bg-gray-50 opacity-75">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @php
                                        $firstImage = is_array($product->image_path) ? ($product->image_path[0] ?? null) : $product->image_path;
                                    @endphp
                                    @if($firstImage)
                                        <img src="{{ asset('storage/' . $firstImage) }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-lg object-cover mr-4 grayscale">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center mr-4">
                                            🗃️
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($product->description, 40) }}</div>
                                        @if($product->is_organic)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Organic
                                            </span>
                                        @endif
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                            Archived
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $product->category }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                ₱{{ number_format($product->price, 2) }}/{{ $product->unit }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $product->deleted_at->format('M d, Y') }}
                                <div class="text-xs text-gray-400">{{ $product->deleted_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <!-- Restore Button -->
                                    <form method="POST" action="{{ route('admin.products.restore', $product->id) }}" 
                                          class="inline" 
                                          onsubmit="return confirm('Are you sure you want to restore this product?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-green-600 hover:text-green-900">
                                            Restore
                                        </button>
                                    </form>
                                    
                                    <!-- Permanent Delete Button -->
                                    <form method="POST" action="{{ route('admin.products.force-delete', $product->id) }}" 
                                          class="inline" 
                                          onsubmit="return confirm('Are you sure you want to PERMANENTLY delete this product? This action cannot be undone!')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            Delete Forever
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $products->links() }}
        </div>
    @else
        <div class="px-6 py-12 text-center">
            <div class="text-gray-500 text-6xl mb-4">🗃️</div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No archived products</h3>
            <p class="text-gray-500 mb-4">Archived products will appear here when you archive them from the products page.</p>
            <a href="{{ route('admin.products.index') }}" 
               class="bg-admin-accent text-white px-6 py-2 rounded-lg hover:bg-green-600 transition duration-300">
                Go to Products
            </a>
        </div>
    @endif
</div>

@if(session('success'))
    <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
        {{ session('success') }}
    </div>
@endif
@endsection