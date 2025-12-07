<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'category' => 'required|string|max:100',
            'farm_name' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock_quantity' => 'required|integer|min:0'
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['is_organic'] = $request->has('is_organic');

        // Handle multiple image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            $manager = new ImageManager(new Driver());
            
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                
                // Process image with Intervention/Image v3
                $img = $manager->read($image->getRealPath());
                $img->scale(width: 800, height: 600);
                $img->greyscale();
                
                // Save to storage/app/public/products
                $img->save(storage_path('app/public/products/' . $filename));
                
                $imagePaths[] = 'products/' . $filename;
            }
            
            $validated['image_path'] = $imagePaths;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'category' => 'required|string|max:100',
            'farm_name' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock_quantity' => 'required|integer|min:0'
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['is_organic'] = $request->has('is_organic');

        // Handle multiple image uploads
        $existingImages = is_array($product->image_path) ? $product->image_path : [];
        
        if ($request->hasFile('images')) {
            $manager = new ImageManager(new Driver());
            
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                
                // Process image with Intervention/Image v3
                $img = $manager->read($image->getRealPath());
                $img->scale(width: 800, height: 600);
                $img->greyscale();

                
                // Save to storage/app/public/products
                $img->save(storage_path('app/public/products/' . $filename));
                
                $existingImages[] = 'products/' . $filename;
            }
            
            $validated['image_path'] = $existingImages;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    // Delete single image from product
    public function deleteImage(Product $product, $index)
    {
        $images = is_array($product->image_path) ? $product->image_path : [];
        
        if (isset($images[$index])) {
            // Delete physical file
            if (Storage::disk('public')->exists($images[$index])) {
                Storage::disk('public')->delete($images[$index]);
            }
            
            // Remove from array
            array_splice($images, $index, 1);
            
            // Update product
            $product->image_path = array_values($images); // Re-index array
            $product->save();
        }
        
        return back()->with('success', 'Image deleted successfully!');
    }

    //soft delete   
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product archived successfully!');
    }

    //soft deleted products
    public function archived()
    {
        $products = Product::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(15);
        return view('admin.products.archived', compact('products'));
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('admin.products.archived')
            ->with('success', 'Product restored successfully!');
    }

    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();

        return redirect()->route('admin.products.archived')
            ->with('success', 'Product permanently deleted!');
    }
}
