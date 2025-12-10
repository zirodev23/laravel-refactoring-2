<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/products', function () {
    $products = \App\Models\Product::paginate(12);
    return view('products', compact('products'));
})->name('products.index');

// Orders
Route::get('/orders', function () {
    // Show all orders, not just user-specific ones
    $orders = \App\Models\Order::latest()->paginate(10);
    return view('orders.index', compact('orders'));
})->name('orders.index');

Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
