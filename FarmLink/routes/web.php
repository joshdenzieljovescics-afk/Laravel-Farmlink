<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;

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
