<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────
//  PUBLIC ROUTES
// ─────────────────────────────────────
Route::get('/', [ProductController::class, 'index'])->name('home');

// ─────────────────────────────────────
//  AUTH ROUTES
// ─────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ─────────────────────────────────────
//  PEMBELI ROUTES (CheckLogin middleware)
// ─────────────────────────────────────
Route::middleware(\App\Http\Middleware\CheckLogin::class)->group(function () {
    Route::get('/checkout/{product}', [OrderController::class, 'checkout'])->name('checkout.form');
    Route::post('/checkout/{product}', [OrderController::class, 'store'])->name('checkout.store');
    Route::get('/pesanan-saya', [OrderController::class, 'myOrders'])->name('orders.my');
});

// ─────────────────────────────────────
//  ADMIN ROUTES (AdminOnly middleware)
// ─────────────────────────────────────
Route::middleware(\App\Http\Middleware\AdminOnly::class)->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Kelola Produk
    Route::get('/produk', [ProductController::class, 'adminIndex'])->name('products.index');
    Route::get('/produk/tambah', [ProductController::class, 'create'])->name('products.create');
    Route::post('/produk', [ProductController::class, 'store'])->name('products.store');
    Route::get('/produk/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/produk/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/produk/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Kelola Pesanan
    Route::get('/pesanan', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::put('/pesanan/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});
