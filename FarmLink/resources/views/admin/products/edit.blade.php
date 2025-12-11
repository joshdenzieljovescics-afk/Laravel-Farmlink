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
    <div class="bg-gradient-to-r from-green-600 to-green-700 text-white py-12 mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2">Edit Product</h1>
                    <p class="text-green-100">Update product information for {{ $product->name }}</p>
                </div>
                <div class="hidden md:block">
                    <svg class="w-24 h-24 text-green-500 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="p-8 md:p-12">
                    <!-- Product Images Section -->
                    <div class="mb-10">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-800">Product Images</h3>
                        </div>

                        @if($product->image_path && is_array($product->image_path) && count($product->image_path) > 0)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-3 font-medium">Current Images:</p>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                    @foreach($product->image_path as $index => $imagePath)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/products/thumbnails/' . $imagePath) }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="w-full h-32 object-cover rounded-lg border-2 border-green-200 group-hover:border-green-400 transition-all duration-200">
                                            <button type="button"
                                                    onclick="deleteImage({{ $product->id }}, {{ $index }})"
                                                    class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded-full opacity-0 group-hover:opacity-100 transition-all shadow-lg flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="bg-gradient-to-br from-green-50 to-green-100 border-2 border-dashed border-green-300 rounded-xl p-8 text-center hover:border-green-500 transition-all duration-300">
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
                                <p class="text-lg font-medium text-gray-700 mb-1">Click to upload product images</p>
                                <p class="text-sm text-gray-500">PNG, JPG, WEBP up to 5MB each</p>
                            </label>
                            <div id="preview" class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4"></div>
                        </div>
                    </div>

                    <!-- Basic Information Section -->
                    <div class="mb-10">
                        <div class="flex items-center mb-6">
                            <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-800">Basic Information</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Product Name -->
                            <div class="md:col-span-2">
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Product Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name', $product->name) }}"
                                       placeholder="e.g., Fresh Organic Tomatoes"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200" 
                                       required>
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Category <span class="text-red-500">*</span>
                                </label>
                                <select name="category" 
                                        id="category" 
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200" 
                                        required>
                                    <option value="">Select Category</option>
                                    <option value="Vegetables" {{ old('category', $product->category) == 'Vegetables' ? 'selected' : '' }}>🥕 Vegetables</option>
                                    <option value="Fruits" {{ old('category', $product->category) == 'Fruits' ? 'selected' : '' }}>🍎 Fruits</option>
                                    <option value="Grains" {{ old('category', $product->category) == 'Grains' ? 'selected' : '' }}>🌾 Grains</option>
                                    <option value="Herbs" {{ old('category', $product->category) == 'Herbs' ? 'selected' : '' }}>🌿 Herbs</option>
                                    <option value="Dairy" {{ old('category', $product->category) == 'Dairy' ? 'selected' : '' }}>🥛 Dairy</option>
                                    <option value="Meat" {{ old('category', $product->category) == 'Meat' ? 'selected' : '' }}>🥩 Meat</option>
                                    <option value="Other" {{ old('category', $product->category) == 'Other' ? 'selected' : '' }}>📦 Other</option>
                                </select>
                            </div>

                            <!-- Farm Name -->
                            <div>
                                <label for="farm_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Farm Name
                                </label>
                                <input type="text" 
                                       name="farm_name" 
                                       id="farm_name" 
                                       value="{{ old('farm_name', $product->farm_name) }}"
                                       placeholder="e.g., Green Valley Farm"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200">
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Product Description
                                </label>
                                <textarea name="description" 
                                          id="description" 
                                          rows="5" 
                                          placeholder="Describe your product, including freshness, origin, and any special qualities..."
                                          class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 resize-none">{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing & Inventory Section -->
                    <div class="mb-10">
                        <div class="flex items-center mb-6">
                            <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-800">Pricing & Inventory</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Price -->
                            <div>
                                <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Price (₱) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">₱</span>
                                    <input type="number" 
                                           name="price" 
                                           id="price" 
                                           value="{{ old('price', $product->price) }}"
                                           step="0.01" 
                                           min="0"
                                           placeholder="0.00"
                                           class="w-full pl-8 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200" 
                                           required>
                                </div>
                            </div>

                            <!-- Unit Measure -->
                            <div>
                                <label for="unit" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Unit <span class="text-red-500">*</span>
                                </label>
                                <select name="unit" 
                                        id="unit" 
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200" 
                                        required>
                                    <option value="">Select Unit</option>
                                    <option value="kg" {{ old('unit', $product->unit) == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                                    <option value="lb" {{ old('unit', $product->unit) == 'lb' ? 'selected' : '' }}>Pound (lb)</option>
                                    <option value="piece" {{ old('unit', $product->unit) == 'piece' ? 'selected' : '' }}>Piece</option>
                                    <option value="bunch" {{ old('unit', $product->unit) == 'bunch' ? 'selected' : '' }}>Bunch</option>
                                    <option value="bag" {{ old('unit', $product->unit) == 'bag' ? 'selected' : '' }}>Bag</option>
                                    <option value="box" {{ old('unit', $product->unit) == 'box' ? 'selected' : '' }}>Box</option>
                                </select>
                            </div>

                            <!-- Available Quantity -->
                            <div>
                                <label for="stock_quantity" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Stock Quantity <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       name="stock_quantity" 
                                       id="stock_quantity" 
                                       value="{{ old('stock_quantity', $product->stock_quantity) }}"
                                       step="0.01" 
                                       min="0"
                                       placeholder="0"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200" 
                                       required>
                            </div>
                        </div>
                    </div>

                    <!-- Special Features Section -->
                    <div class="mb-10">
                        <div class="flex items-center mb-6">
                            <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    <span class="text-2xl mr-2">🌱</span>
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
                                class="flex-1 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white py-4 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Product
                        </button>
                        <a href="{{ route('admin.products.index') }}" 
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
        function handleFileSelect(event) {
            const files = event.target.files;
            const preview = document.getElementById('preview');
            preview.innerHTML = '';

            if (files.length > 0) {
                Array.from(files).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative group';
                        div.innerHTML = `
                            <img src="${e.target.result}" 
                                 class="w-full h-32 object-cover rounded-lg border-2 border-green-200 group-hover:border-green-400 transition-all duration-200 shadow-sm"
                                 alt="Preview ${index + 1}">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-lg transition-all duration-200 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                        `;
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            }
        }

        function deleteImage(productId, imageIndex) {
            if (confirm('Delete this image?')) {
                // Create a temporary form to submit the delete request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/products/${productId}/images/${imageIndex}`;
                
                // Add CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);
                
                // Add DELETE method
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
                
                // Submit the form
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>