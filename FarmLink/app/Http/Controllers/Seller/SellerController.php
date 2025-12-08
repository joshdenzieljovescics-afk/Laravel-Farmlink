<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class SellerController extends Controller
{
    // Display the seller dashboard with their products.
    public function index()
    {
        $products = Product::where('accID', Auth::id())
            ->where('status', 'Y')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('seller.dashboard', compact('products'));
    }

    // Show the form for creating a new product
    public function create()
    {
        return view('seller.create');
    }

    // Store a newly created product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'unit_measure' => 'required|string|max:50',
            'product_category' => 'required|string|max:100',
            'avail_qty' => 'required|numeric|min:0',
            'farm_name' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'is_organic' => 'nullable|boolean',
        ]);

        // Handle multiple image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            $manager = new ImageManager(new Driver());

            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.webp';

                // Process image with Intervention/Image
                $img = $manager->read($image->getRealPath());
                $img->scale(width: 800);

                // Save to storage/app/public/products
                $img->save(storage_path('app/public/products/' . $filename));

                // Create thumbnail
                $thumb = $manager->read($image->getRealPath());
                $thumb->cover(200, 200);
                $thumb->save(storage_path('app/public/products/thumbnails/' . $filename));

                $imagePaths[] = $filename;
            }
        }

        // Create product with seller's ID
        Product::create([
            'product_name' => $validated['product_name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'unit_measure' => $validated['unit_measure'],
            'product_category' => $validated['product_category'],
            'avail_qty' => $validated['avail_qty'],
            'farm_name' => $validated['farm_name'] ?? null,
            'image_path' => $imagePaths,
            'is_organic' => $validated['is_organic'] ?? false,
            'accID' => Auth::id(),
            'status' => 'Y',
        ]);

        return redirect()
            ->route('seller.dashboard')
            ->with('success', 'Product added successfully!');
    }

    // Shows the form for editing the specified product
    public function edit(Product $product)
    {
        // Check if the product belongs to the authenticated seller
        if ($product->accID !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('seller.edit', compact('product'));
    }

    // Update the specified product
    public function update(Request $request, Product $product)
    {
        // Check if the product belongs to the authenticated seller
        if ($product->accID !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'unit_measure' => 'required|string|max:50',
            'product_category' => 'required|string|max:100',
            'avail_qty' => 'required|numeric|min:0',
            'farm_name' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'is_organic' => 'nullable|boolean',
        ]);

        $imagePaths = $product->image_path ?? [];

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $manager = new ImageManager(new Driver());

            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.webp';

                // Process image
                $img = $manager->read($image->getRealPath());
                $img->scale(width: 800);
                $img->save(storage_path('app/public/products/' . $filename));

                // Create thumbnail
                $thumb = $manager->read($image->getRealPath());
                $thumb->cover(200, 200);
                $thumb->save(storage_path('app/public/products/thumbnails/' . $filename));

                $imagePaths[] = $filename;
            }
        }

        // Update product
        $product->update([
            'product_name' => $validated['product_name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'unit_measure' => $validated['unit_measure'],
            'product_category' => $validated['product_category'],
            'avail_qty' => $validated['avail_qty'],
            'farm_name' => $validated['farm_name'] ?? null,
            'image_path' => $imagePaths,
            'is_organic' => $validated['is_organic'] ?? false,
        ]);

        return redirect()
            ->route('seller.dashboard')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Soft delete the specified product
     */
    public function destroy(Product $product)
    {
        // Check if the product belongs to the authenticated seller
        if ($product->accID !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Soft delete by setting status to 'N'
        $product->update(['status' => 'N']);

        return redirect()
            ->route('seller.dashboard')
            ->with('success', 'Product deleted successfully!');
    }

    /**
     * Delete a specific image from a product
     */
    public function deleteImage(Request $request, Product $product)
    {
        // Check if the product belongs to the authenticated seller
        if ($product->accID !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $imageToDelete = $request->input('image');
        $imagePaths = $product->image_path ?? [];

        // Remove the image from array
        $imagePaths = array_values(array_filter($imagePaths, function ($img) use ($imageToDelete) {
            return $img !== $imageToDelete;
        }));

        // Delete physical files
        if (Storage::disk('public')->exists('products/' . $imageToDelete)) {
            Storage::disk('public')->delete('products/' . $imageToDelete);
        }
        if (Storage::disk('public')->exists('products/thumbnails/' . $imageToDelete)) {
            Storage::disk('public')->delete('products/thumbnails/' . $imageToDelete);
        }

        // Update product
        $product->update(['image_path' => $imagePaths]);

        return back()->with('success', 'Image deleted successfully!');
    }
}
