@extends('admin.layout')

@section('title', 'Add New Product')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center mb-8">
        <a href="{{ route('admin.products.index') }}" 
           class="text-gray-600 hover:text-gray-800 mr-4">
            ← Back to Products
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Add New Product</h1>
    </div>

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg p-8">
        @csrf
        
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Name -->
            <div class="md:col-span-2">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Product Name *</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}"
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
                    <option value="Vegetables" {{ old('category') == 'Vegetables' ? 'selected' : '' }}>Vegetables</option>
                    <option value="Fruits" {{ old('category') == 'Fruits' ? 'selected' : '' }}>Fruits</option>
                    <option value="Herbs" {{ old('category') == 'Herbs' ? 'selected' : '' }}>Herbs</option>
                    <option value="Grains" {{ old('category') == 'Grains' ? 'selected' : '' }}>Grains</option>
                    <option value="Dairy" {{ old('category') == 'Dairy' ? 'selected' : '' }}>Dairy</option>
                    <option value="Meat" {{ old('category') == 'Meat' ? 'selected' : '' }}>Meat</option>
                    <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <!-- Farm Name -->
            <div>
                <label for="farm_name" class="block text-sm font-medium text-gray-700 mb-2">Farm Name</label>
                <input type="text" 
                       id="farm_name" 
                       name="farm_name" 
                       value="{{ old('farm_name') }}"
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
                           value="{{ old('price') }}"
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
                        
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent">
                    <option value="">Select Unit</option>
                    <option value="lb" {{ old('unit') == 'lb' ? 'selected' : '' }}>lb (pound)</option>
                    <option value="kg" {{ old('unit') == 'kg' ? 'selected' : '' }}>kg (kilogram)</option>
                    <option value="piece" {{ old('unit') == 'piece' ? 'selected' : '' }}>piece</option>
                    <option value="bunch" {{ old('unit') == 'bunch' ? 'selected' : '' }}>bunch</option>
                    <option value="bag" {{ old('unit') == 'bag' ? 'selected' : '' }}>bag</option>
                    <option value="box" {{ old('unit') == 'box' ? 'selected' : '' }}>box</option>
                </select>
            </div>

            <!-- Stock Quantity -->
            <div>
                <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-2">Stock Quantity *</label>
                <input type="number" 
                       id="stock_quantity" 
                       name="stock_quantity" 
                       value="{{ old('stock_quantity', 0) }}"
                       min="0"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent">
            </div>

            <!-- Image Upload -->
            <div class="md:col-span-2">
                <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Product Images</label>
                <input type="file" 
                       id="images" 
                       name="images[]"
                       accept="image/*"
                       multiple
                       onchange="previewImages(event)"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent">
                <p class="text-sm text-gray-500 mt-1">Upload multiple product images (JPEG, PNG, JPG, GIF - Max: 2MB each)</p>
                
                <!-- Image Previews -->
                <div id="imagePreviews" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 hidden">
                </div>
            </div>

            <script>
                function previewImages(event) {
                    const previewContainer = document.getElementById('imagePreviews');
                    const files = event.target.files;
                    
                    if (files.length > 0) {
                        previewContainer.innerHTML = '';
                        previewContainer.classList.remove('hidden');
                        
                        Array.from(files).forEach((file, index) => {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const div = document.createElement('div');
                                div.className = 'relative';
                                div.innerHTML = `
                                    <img src="${e.target.result}" alt="Preview ${index + 1}" 
                                         class="w-full h-32 object-cover rounded-lg border border-gray-300">
                                    <span class="absolute top-1 right-1 bg-gray-800 text-white text-xs px-2 py-1 rounded">
                                        ${index + 1}
                                    </span>
                                `;
                                previewContainer.appendChild(div);
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
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent">{{ old('description') }}</textarea>
            </div>

            <!-- Checkboxes -->
            <div class="md:col-span-2">
                <div class="flex space-x-6">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="is_active" 
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="w-4 h-4 text-admin-accent border-gray-300 rounded focus:ring-admin-accent">
                        <span class="ml-2 text-sm text-gray-700">Active (visible to customers)</span>
                    </label>
                    
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="is_organic" 
                               {{ old('is_organic') ? 'checked' : '' }}
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
                Create Product
            </button>
        </div>
    </form>
</div>
@endsection