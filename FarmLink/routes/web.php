<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

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

// Buyer routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [BuyerController::class, 'dashboard'])->name('dashboard');
    Route::get('/buyer/orders', [OrderController::class, 'index'])->name('buyer.orders');
    Route::get('/buyer/orders/{id}', [OrderController::class, 'show'])->name('buyer.orders.show');
    Route::get('/topup', [TopUpController::class, 'index'])->name('topup');
    Route::post('/topup/process', [TopUpController::class, 'process'])->name('topup.process');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
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

    // Order management routes
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{id}/approve', [App\Http\Controllers\Admin\OrderController::class, 'approve'])->name('admin.orders.approve');
    Route::post('/orders/{id}/reject', [App\Http\Controllers\Admin\OrderController::class, 'reject'])->name('admin.orders.reject');
});

// Seller routes - for farmers to manage their products
Route::middleware(['auth', 'verified'])->prefix('seller')->group(function () {
    Route::get('/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::get('/products/create', [SellerController::class, 'create'])->name('seller.products.create');
    Route::post('/products', [SellerController::class, 'store'])->name('seller.products.store');
    Route::get('/products/archived', [SellerController::class, 'archived'])->name('seller.products.archived');
    Route::get('/products/{product}/edit', [SellerController::class, 'edit'])->name('seller.products.edit');
    Route::put('/products/{product}', [SellerController::class, 'update'])->name('seller.products.update');
    Route::delete('/products/{product}', [SellerController::class, 'destroy'])->name('seller.products.destroy');
    Route::post('/products/{id}/restore', [SellerController::class, 'restore'])->name('seller.products.restore');
    Route::delete('/products/{id}/force-delete', [SellerController::class, 'forceDelete'])->name('seller.products.forceDelete');
    Route::delete('/products/{product}/image', [SellerController::class, 'deleteImage'])->name('seller.products.deleteImage');
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{id}/approve', [App\Http\Controllers\Admin\OrderController::class, 'approve'])->name('admin.orders.approve');
    Route::post('/orders/{id}/reject', [App\Http\Controllers\Admin\OrderController::class, 'reject'])->name('admin.orders.reject');
});
