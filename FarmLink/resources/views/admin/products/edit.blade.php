@extends('admin.layout')

@section('title', 'Edit Product')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center mb-8">
        <a href="{{ route('admin.products.index') }}" 
           class="text-gray-600 hover:text-gray-800 mr-4">
            ← Back to Products
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Edit Product: {{ $product->name }}</h1>
    </div>

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg p-8">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Name -->
            <div class="md:col-span-2">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Product Name *</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $product->name) }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent">
            </div>

            <!-- Category -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                <select id="category" 
                        name="category" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent">
                    <option value="">Select Category</option>
                    <option value="Vegetables" {{ old('category', $product->category) == 'Vegetables' ? 'selected' : '' }}>Vegetables</option>
                    <option value="Fruits" {{ old('category', $product->category) == 'Fruits' ? 'selected' : '' }}>Fruits</option>
                    <option value="Herbs" {{ old('category', $product->category) == 'Herbs' ? 'selected' : '' }}>Herbs</option>
                    <option value="Grains" {{ old('category', $product->category) == 'Grains' ? 'selected' : '' }}>Grains</option>
                    <option value="Dairy" {{ old('category', $product->category) == 'Dairy' ? 'selected' : '' }}>Dairy</option>
                    <option value="Meat" {{ old('category', $product->category) == 'Meat' ? 'selected' : '' }}>Meat</option>
                    <option value="Other" {{ old('category', $product->category) == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <!-- Farm Name -->
            <div>
                <label for="farm_name" class="block text-sm font-medium text-gray-700 mb-2">Farm Name</label>
                <input type="text" 
                       id="farm_name" 
                       name="farm_name" 
                       value="{{ old('farm_name', $product->farm_name) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent">
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price (PHP) *</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">₱</span>
                    <input type="number" 
                           id="price" 
                           name="price" 
                           value="{{ old('price', $product->price) }}"
                           step="0.01"
                           min="0"
                           required
                           class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent">
                </div>
            </div>

            <!-- Unit -->
            <div>
                <label for="unit" class="block text-sm font-medium text-gray-700 mb-2">Unit *</label>
                <select id="unit" 
                        name="unit" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent">
                    <option value="">Select Unit</option>
                    <option value="lb" {{ old('unit', $product->unit) == 'lb' ? 'selected' : '' }}>lb (pound)</option>
                    <option value="kg" {{ old('unit', $product->unit) == 'kg' ? 'selected' : '' }}>kg (kilogram)</option>
                    <option value="piece" {{ old('unit', $product->unit) == 'piece' ? 'selected' : '' }}>piece</option>
                    <option value="bunch" {{ old('unit', $product->unit) == 'bunch' ? 'selected' : '' }}>bunch</option>
                    <option value="bag" {{ old('unit', $product->unit) == 'bag' ? 'selected' : '' }}>bag</option>
                    <option value="box" {{ old('unit', $product->unit) == 'box' ? 'selected' : '' }}>box</option>
                </select>
            </div>

            <!-- Stock Quantity -->
            <div>
                <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-2">Stock Quantity *</label>
                <input type="number" 
                       id="stock_quantity" 
                       name="stock_quantity" 
                       value="{{ old('stock_quantity', $product->stock_quantity) }}"
                       min="0"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent">
            </div>

            <!-- Image URL -->
            <!-- Image Upload -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Product Images</label>
                
                @if($product->image_path && is_array($product->image_path) && count($product->image_path) > 0)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Current Images:</p>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($product->image_path as $index => $imagePath)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $imagePath) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-32 object-cover rounded-lg border border-gray-300">
                                    <form method="POST" 
                                          action="{{ route('admin.products.deleteImage', [$product, $index]) }}" 
                                          class="absolute top-2 right-2"
                                          onsubmit="return confirm('Delete this image?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition">
                                            ✕
                                        </button>
                                    </form>
                                    <span class="absolute bottom-2 left-2 bg-gray-800 text-white text-xs px-2 py-1 rounded">
                                        {{ $index + 1 }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                <input type="file" 
                       id="images" 
                       name="images[]"
                       accept="image/*"
                       multiple
                       onchange="previewImages(event)"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent">
                <p class="text-sm text-gray-500 mt-1">Upload additional images (JPEG, PNG, JPG, GIF - Max: 2MB each)</p>
                
                <!-- New Image Previews -->
                <div id="imagePreviews" class="mt-4 hidden">
                    <p class="text-sm text-gray-600 mb-2">New Images to Upload:</p>
                    <div id="previewGrid" class="grid grid-cols-2 md:grid-cols-4 gap-4"></div>
                </div>
            </div>

            <script>
                function previewImages(event) {
                    const previewContainer = document.getElementById('imagePreviews');
                    const previewGrid = document.getElementById('previewGrid');
                    const files = event.target.files;
                    
                    if (files.length > 0) {
                        previewGrid.innerHTML = '';
                        previewContainer.classList.remove('hidden');
                        
                        Array.from(files).forEach((file, index) => {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const div = document.createElement('div');
                                div.className = 'relative';
                                div.innerHTML = `
                                    <img src="${e.target.result}" alt="Preview ${index + 1}" 
                                         class="w-full h-32 object-cover rounded-lg border border-green-300">
                                    <span class="absolute top-1 right-1 bg-green-600 text-white text-xs px-2 py-1 rounded">
                                        NEW
                                    </span>
                                `;
                                previewGrid.appendChild(div);
                            }
                            reader.readAsDataURL(file);
                        });
                    }
                }
            </script>

            <!-- Description -->
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                <textarea id="description" 
                          name="description" 
                          rows="4" 
                          required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent">{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Checkboxes -->
            <div class="md:col-span-2">
                <div class="flex space-x-6">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="is_active" 
                               {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                               class="w-4 h-4 text-admin-accent border-gray-300 rounded focus:ring-admin-accent">
                        <span class="ml-2 text-sm text-gray-700">Active (visible to customers)</span>
                    </label>
                    
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="is_organic" 
                               {{ old('is_organic', $product->is_organic) ? 'checked' : '' }}
                               class="w-4 h-4 text-admin-accent border-gray-300 rounded focus:ring-admin-accent">
                        <span class="ml-2 text-sm text-gray-700">Organic Product</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.products.index') }}" 
               class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-300">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-admin-accent text-white rounded-lg hover:bg-green-600 transition duration-300">
                Update Product
            </button>
        </div>
    </form>
</div>
@endsection