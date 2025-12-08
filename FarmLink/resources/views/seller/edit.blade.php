@extends('seller.layout')

@section('title', 'Edit Product')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Product</h2>

        <form action="{{ route('seller.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Product Name -->
            <div class="mb-4">
                <label for="product_name" class="block text-gray-700 font-medium mb-2">Product Name *</label>
                <input type="text" 
                       name="product_name" 
                       id="product_name" 
                       value="{{ old('product_name', $product->product_name) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-seller-primary focus:border-transparent" 
                       required>
                @error('product_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label for="product_category" class="block text-gray-700 font-medium mb-2">Category *</label>
                <select name="product_category" 
                        id="product_category" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-seller-primary focus:border-transparent" 
                        required>
                    <option value="">Select Category</option>
                    <option value="Vegetables" {{ old('product_category', $product->product_category) == 'Vegetables' ? 'selected' : '' }}>Vegetables</option>
                    <option value="Fruits" {{ old('product_category', $product->product_category) == 'Fruits' ? 'selected' : '' }}>Fruits</option>
                    <option value="Grains" {{ old('product_category', $product->product_category) == 'Grains' ? 'selected' : '' }}>Grains</option>
                    <option value="Berries" {{ old('product_category', $product->product_category) == 'Berries' ? 'selected' : '' }}>Berries</option>
                    <option value="Herbs" {{ old('product_category', $product->product_category) == 'Herbs' ? 'selected' : '' }}>Herbs</option>
                    <option value="Dairy" {{ old('product_category', $product->product_category) == 'Dairy' ? 'selected' : '' }}>Dairy</option>
                    <option value="Meat" {{ old('product_category', $product->product_category) == 'Meat' ? 'selected' : '' }}>Meat</option>
                    <option value="Other" {{ old('product_category', $product->product_category) == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('product_category')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea name="description" 
                          id="description" 
                          rows="4" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-seller-primary focus:border-transparent">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price and Unit -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="price" class="block text-gray-700 font-medium mb-2">Price (₱) *</label>
                    <input type="number" 
                           name="price" 
                           id="price" 
                           value="{{ old('price', $product->price) }}"
                           step="0.01" 
                           min="0" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-seller-primary focus:border-transparent" 
                           required>
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="unit_measure" class="block text-gray-700 font-medium mb-2">Unit *</label>
                    <select name="unit_measure" 
                            id="unit_measure" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-seller-primary focus:border-transparent" 
                            required>
                        <option value="">Select Unit</option>
                        <option value="kg" {{ old('unit_measure', $product->unit_measure) == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                        <option value="lb" {{ old('unit_measure', $product->unit_measure) == 'lb' ? 'selected' : '' }}>Pound (lb)</option>
                        <option value="piece" {{ old('unit_measure', $product->unit_measure) == 'piece' ? 'selected' : '' }}>Piece</option>
                        <option value="dozen" {{ old('unit_measure', $product->unit_measure) == 'dozen' ? 'selected' : '' }}>Dozen</option>
                        <option value="bundle" {{ old('unit_measure', $product->unit_measure) == 'bundle' ? 'selected' : '' }}>Bundle</option>
                    </select>
                    @error('unit_measure')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Available Quantity -->
            <div class="mb-4">
                <label for="avail_qty" class="block text-gray-700 font-medium mb-2">Available Quantity *</label>
                <input type="number" 
                       name="avail_qty" 
                       id="avail_qty" 
                       value="{{ old('avail_qty', $product->avail_qty) }}"
                       step="0.01" 
                       min="0" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-seller-primary focus:border-transparent" 
                       required>
                @error('avail_qty')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Farm Name -->
            <div class="mb-4">
                <label for="farm_name" class="block text-gray-700 font-medium mb-2">Farm Name</label>
                <input type="text" 
                       name="farm_name" 
                       id="farm_name" 
                       value="{{ old('farm_name', $product->farm_name) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-seller-primary focus:border-transparent">
                @error('farm_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Is Organic -->
            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="is_organic" 
                           value="1" 
                           {{ old('is_organic', $product->is_organic) ? 'checked' : '' }}
                           class="w-4 h-4 text-seller-primary border-gray-300 rounded focus:ring-seller-primary">
                    <span class="ml-2 text-gray-700">This is an organic product 🌱</span>
                </label>
            </div>

            <!-- Current Images -->
            @if($product->image_path && is_array($product->image_path) && count($product->image_path) > 0)
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Current Images</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($product->image_path as $image)
                    <div class="relative group">
                        <img src="{{ asset('storage/products/thumbnails/' . $image) }}" 
                             alt="Product image" 
                             class="w-full h-32 object-cover rounded-lg">
                        <form action="{{ route('seller.products.deleteImage', $product) }}" 
                              method="POST" 
                              class="absolute top-2 right-2"
                              onsubmit="return confirm('Delete this image?');">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="image" value="{{ $image }}">
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 text-white rounded-full p-2 opacity-0 group-hover:opacity-100 transition">
                                ✕
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Add New Images -->
            <div class="mb-6">
                <label for="images" class="block text-gray-700 font-medium mb-2">Add New Images</label>
                <input type="file" 
                       name="images[]" 
                       id="images" 
                       multiple 
                       accept="image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-seller-primary focus:border-transparent">
                <p class="text-sm text-gray-500 mt-1">You can upload multiple images (Max 5MB each, JPEG, PNG, GIF, WEBP)</p>
                @error('images.*')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit" 
                        class="flex-1 bg-seller-primary hover:bg-seller-secondary text-white py-3 rounded-lg font-medium transition duration-300">
                    Update Product
                </button>
                <a href="{{ route('seller.dashboard') }}" 
                   class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 rounded-lg font-medium text-center transition duration-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
