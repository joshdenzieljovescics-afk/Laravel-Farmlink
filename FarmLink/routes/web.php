<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome-new');
})->name('home');

Route::get('/products', [App\Http\Controllers\ProductPageController::class, 'index'])->name('products');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/developers', function () {
    return view('developers');
})->name('developers');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');

    // Product management routes
    Route::resource('products', ProductController::class, [
        'as' => 'admin'
    ]);

    // Delete individual image
    Route::delete('/products/{product}/images/{index}', [ProductController::class, 'deleteImage'])->name('admin.products.deleteImage');

    // Archived products routes
    Route::get('/products-archived', [ProductController::class, 'archived'])->name('admin.products.archived');
    Route::patch('/products-archived/{id}/restore', [ProductController::class, 'restore'])->name('admin.products.restore');
    Route::delete('/products-archived/{id}/force-delete', [ProductController::class, 'forceDelete'])->name('admin.products.force-delete');
});

// Seller routes - for farmers to manage their products
Route::middleware(['auth', 'verified'])->prefix('seller')->group(function () {
    Route::get('/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::get('/products/create', [SellerController::class, 'create'])->name('seller.products.create');
    Route::post('/products', [SellerController::class, 'store'])->name('seller.products.store');
    Route::get('/products/{product}/edit', [SellerController::class, 'edit'])->name('seller.products.edit');
    Route::put('/products/{product}', [SellerController::class, 'update'])->name('seller.products.update');
    Route::delete('/products/{product}', [SellerController::class, 'destroy'])->name('seller.products.destroy');
    Route::delete('/products/{product}/image', [SellerController::class, 'deleteImage'])->name('seller.products.deleteImage');
});
