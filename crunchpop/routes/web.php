<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomOrderController;
use App\Http\Controllers\EarlyListController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public site
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/mission', [PageController::class, 'mission'])->name('mission');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product:slug}', [ShopController::class, 'show'])->name('shop.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{orderNumber}', [CheckoutController::class, 'success'])->name('checkout.success');

// Custom orders
Route::get('/custom-orders', [CustomOrderController::class, 'index'])->name('custom.index');
Route::post('/custom-orders', [CustomOrderController::class, 'store'])->name('custom.store');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Early Field & Pantry list
Route::post('/early-list', [EarlyListController::class, 'store'])->name('early-list.store');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [Admin\AuthController::class, 'login'])->name('login.attempt');
    Route::post('logout', [Admin\AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('products', Admin\ProductController::class)->except('show');

        Route::get('orders', [Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [Admin\OrderController::class, 'show'])->name('orders.show');
        Route::patch('orders/{order}/status', [Admin\OrderController::class, 'updateStatus'])->name('orders.status');
        Route::delete('orders/{order}', [Admin\OrderController::class, 'destroy'])->name('orders.destroy');

        Route::get('custom-orders', [Admin\CustomOrderController::class, 'index'])->name('custom-orders.index');
        Route::get('custom-orders/{customOrder}', [Admin\CustomOrderController::class, 'show'])->name('custom-orders.show');
        Route::patch('custom-orders/{customOrder}/status', [Admin\CustomOrderController::class, 'updateStatus'])->name('custom-orders.status');
        Route::delete('custom-orders/{customOrder}', [Admin\CustomOrderController::class, 'destroy'])->name('custom-orders.destroy');

        Route::get('early-list', [Admin\EarlyListController::class, 'index'])->name('early-list.index');
        Route::get('early-list/export', [Admin\EarlyListController::class, 'export'])->name('early-list.export');
        Route::delete('early-list/{earlyList}', [Admin\EarlyListController::class, 'destroy'])->name('early-list.destroy');

        Route::get('contacts', [Admin\ContactController::class, 'index'])->name('contacts.index');
        Route::get('contacts/{contact}', [Admin\ContactController::class, 'show'])->name('contacts.show');
        Route::delete('contacts/{contact}', [Admin\ContactController::class, 'destroy'])->name('contacts.destroy');
    });
});
