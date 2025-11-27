<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuilderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ComponentCatalogController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PreBuiltController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/builder', [BuilderController::class, 'index'])->name('builder');

Route::get('/prebuilt', [PreBuiltController::class, 'index'])->name('prebuilt');
Route::get('/prebuilt/{id}', [PreBuiltController::class, 'show'])->name('prebuilt.show');
Route::post('/prebuilt/{id}/add-to-cart', [PreBuiltController::class, 'addToCart'])->name('prebuilt.addToCart');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/reset', [CartController::class, 'reset'])->name('cart.reset');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

Route::get('/components', [ComponentCatalogController::class, 'index'])->name('components.catalog');

// Simple Auth routes (no Breeze)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Dashboard shortcut
Route::get('/dashboard', function () {
    if (Auth::user()?->is_admin) {
        return redirect()->route('admin.components.index');
    }
    return redirect()->route('home');
})->middleware('auth')->name('dashboard');

// Admin routes (auth + admin middleware)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::redirect('/admin', '/admin/components')->name('admin.dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('components', ComponentController::class)->except(['show']);
    });
});

