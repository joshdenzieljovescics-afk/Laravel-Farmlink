<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - FarmLink</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-50 via-white to-green-50 min-h-screen pt-16">
    @include('navigation-menu')

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white py-12 mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2">Edit Product</h1>
                    <p class="text-blue-100">Update your product information</p>
                </div>
                <div class="hidden md:block">
                    <svg class="w-24 h-24 text-blue-500 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <form action="{{ route('seller.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="p-8 md:p-12">
                    <!-- Current Images Section -->
                    @if($product->image_path && is_array($product->image_path) && count($product->image_path) > 0)
                    <div class="mb-10">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-800">Current Images</h3>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($product->image_path as $image)
                            <div class="relative group">
                                <img src="{{ asset('storage/products/thumbnails/' . $image) }}" 
                                     alt="Product image" 
                                     class="w-full h-32 object-cover rounded-xl border-2 border-gray-200 group-hover:border-blue-400 transition-all duration-200 shadow-sm">
                                <form action="{{ route('seller.products.deleteImage', $product) }}" 
                                      method="POST" 
                                      class="absolute top-2 right-2"
                                      onsubmit="return confirm('Delete this image?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="image" value="{{ $image }}">
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-200 shadow-lg flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Add New Images Section -->
                    <div class="mb-10">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-800">Add New Images</h3>
                        </div>
                        <div id="uploadBox" class="bg-gradient-to-br from-green-50 to-green-100 border-2 border-dashed border-green-300 rounded-xl p-8 text-center hover:border-green-500 transition-all duration-300">
                            <input type="file" 
                                   name="images[]" 
                                   id="images" 
                                   multiple 
                                   accept="image/*"
                                   class="hidden"
                                   onchange="handleFileSelect(event)">
                            <label for="images" class="cursor-pointer">
                                <svg class="mx-auto h-16 w-16 text-green-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="text-lg font-medium text-gray-700 mb-1">Click to upload additional images</p>
                                <p class="text-sm text-gray-500">PNG, JPG, WEBP up to 5MB each</p>
                            </label>
                        </div>
                        <div id="preview" class="hidden grid grid-cols-2 md:grid-cols-4 gap-4 mt-4"></div>
                        @error('images.*')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Basic Information Section -->
                    <div class="mb-10">
                        <div class="flex items-center mb-6">
                            <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-800">Basic Information</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Product Name -->
                            <div class="md:col-span-2">
                                <label for="product_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Product Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="product_name" 
                                       id="product_name" 
                                       value="{{ old('product_name', $product->product_name) }}"
                                       placeholder="e.g., Fresh Organic Tomatoes"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                       required>
                                @error('product_name')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="product_category" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Category <span class="text-red-500">*</span>
                                </label>
                                <select name="product_category" 
                                        id="product_category" 
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
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
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Farm Name -->
                            <div>
                                <label for="farm_name" class="block text-sm font-semibold text-gray-700 mb-2">Farm Name</label>
                                <input type="text" 
                                       name="farm_name" 
                                       id="farm_name" 
                                       value="{{ old('farm_name', $product->farm_name) }}"
                                       placeholder="e.g., Green Valley Farm"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                @error('farm_name')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                                <textarea name="description" 
                                          id="description" 
                                          rows="4" 
                                          placeholder="Describe your product, its qualities, and what makes it special..."
                                          class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Pricing & Inventory Section -->
                    <div class="mb-10">
                        <div class="flex items-center mb-6">
                            <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-800">Pricing & Inventory</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Price -->
                            <div>
                                <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Price <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold">₱</span>
                                    <input type="number" 
                                           name="price" 
                                           id="price" 
                                           value="{{ old('price', $product->price) }}"
                                           step="0.01" 
                                           min="0"
                                           placeholder="0.00"
                                           class="w-full pl-8 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                           required>
                                </div>
                                @error('price')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Unit Measure -->
                            <div>
                                <label for="unit_measure" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Unit <span class="text-red-500">*</span>
                                </label>
                                <select name="unit_measure" 
                                        id="unit_measure" 
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                        required>
                                    <option value="">Select Unit</option>
                                    <option value="kg" {{ old('unit_measure', $product->unit_measure) == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                                    <option value="lb" {{ old('unit_measure', $product->unit_measure) == 'lb' ? 'selected' : '' }}>Pound (lb)</option>
                                    <option value="piece" {{ old('unit_measure', $product->unit_measure) == 'piece' ? 'selected' : '' }}>Piece</option>
                                    <option value="dozen" {{ old('unit_measure', $product->unit_measure) == 'dozen' ? 'selected' : '' }}>Dozen</option>
                                    <option value="bundle" {{ old('unit_measure', $product->unit_measure) == 'bundle' ? 'selected' : '' }}>Bundle</option>
                                </select>
                                @error('unit_measure')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Available Quantity -->
                            <div>
                                <label for="avail_qty" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Stock Quantity <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       name="avail_qty" 
                                       id="avail_qty" 
                                       value="{{ old('avail_qty', $product->avail_qty) }}"
                                       step="0.01" 
                                       min="0"
                                       placeholder="0"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                       required>
                                @error('avail_qty')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Special Features Section -->
                    <div class="mb-10">
                        <div class="flex items-center mb-6">
                            <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-800">Special Features</h3>
                        </div>

                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" 
                                       name="is_organic" 
                                       value="1" 
                                       {{ old('is_organic', $product->is_organic) ? 'checked' : '' }}
                                       class="w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-2 focus:ring-green-500 transition-all duration-200">
                                <span class="ml-3 flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C11.5 2 11 2.19 10.59 2.59L2.59 10.59C1.8 11.37 1.8 12.63 2.59 13.41L10.59 21.41C11.37 22.2 12.63 22.2 13.41 21.41L21.41 13.41C22.2 12.63 22.2 11.37 21.41 10.59L13.41 2.59C13 2.19 12.5 2 12 2M12 4L20 12L12 20L4 12L12 4M12 7C9.24 7 7 9.24 7 12S9.24 17 12 17 17 14.76 17 12 14.76 7 12 7M12 9C13.66 9 15 10.34 15 12S13.66 15 12 15 9 13.66 9 12 10.34 9 12 9Z"/>
                                    </svg>
                                    <span>
                                        <span class="block text-base font-semibold text-gray-800 group-hover:text-green-700 transition-colors">Organic Product</span>
                                        <span class="block text-sm text-gray-600">Certified organic, chemical-free produce</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-gray-50 px-8 md:px-12 py-6 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-4 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Product
                        </button>
                        <a href="{{ route('seller.dashboard') }}" 
                           class="flex-1 bg-white hover:bg-gray-100 text-gray-700 py-4 rounded-xl font-semibold text-lg border-2 border-gray-300 hover:border-gray-400 transition-all duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let selectedFiles = [];

        function handleFileSelect(event) {
            const files = Array.from(event.target.files);
            selectedFiles = files;
            updatePreview();
        }

        function updatePreview() {
            const preview = document.getElementById('preview');
            const uploadBox = document.getElementById('uploadBox');
            preview.innerHTML = '';

            if (selectedFiles.length > 0) {
                uploadBox.classList.add('hidden');
                preview.classList.remove('hidden');

                selectedFiles.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative group';
                        div.innerHTML = `
                            <img src="${e.target.result}" 
                                 class="w-full h-32 object-cover rounded-lg border-2 border-green-200 group-hover:border-green-400 transition-all duration-200 shadow-sm"
                                 alt="Preview ${index + 1}">
                            <button type="button" 
                                    onclick="removeImage(${index})"
                                    class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-200 shadow-lg flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        `;
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            } else {
                uploadBox.classList.remove('hidden');
                preview.classList.add('hidden');
            }
        }

        function removeImage(index) {
            selectedFiles.splice(index, 1);
            
            // Update the file input
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            document.getElementById('images').files = dt.files;
            
            updatePreview();
        }
    </script>
</body>
</html>
