<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BuilderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PreBuiltController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\ComponentCatalogController;

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// PC Builder Page
Route::get('/builder', [BuilderController::class, 'index'])->name('builder');

// Pre-Built PCs
Route::get('/prebuilt', [PreBuiltController::class, 'index'])->name('prebuilt');
Route::get('/prebuilt/{id}', [PreBuiltController::class, 'show'])->name('prebuilt.show');
Route::post('/prebuilt/{id}/add-to-cart', [PreBuiltController::class, 'addToCart'])->name('prebuilt.addToCart');

// Cart Actions
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/reset', [CartController::class, 'reset'])->name('cart.reset');

// Checkout Page
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

// Component Catalog (Frontend)
Route::get('/components', [ComponentCatalogController::class, 'index'])->name('components.catalog');

// Admin Component Management
Route::redirect('/admin', '/admin/components');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('components', ComponentController::class)->except(['show']);
});
