<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('products.dashboard');
    Route::get('/comunidad-12-octubre', [ProductController::class, 'comunidad'])->name('products.comunidad');
    Route::post('/comunidad-12-octubre/voluntariado/{product}', [\App\Http\Controllers\VolunteerController::class, 'store'])->name('volunteers.store');
    Route::get('/admin/voluntarios', [\App\Http\Controllers\VolunteerController::class, 'admin'])->name('volunteers.admin');
    Route::delete('/admin/voluntarios/{id}', [\App\Http\Controllers\VolunteerController::class, 'destroy'])->name('volunteers.destroy');
    Route::resource('products', ProductController::class);

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Order Routes
    Route::get('/checkout', [\App\Http\Controllers\OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/checkout/process', [\App\Http\Controllers\OrderController::class, 'process'])->name('orders.process');
    Route::get('/orders/success/{id}', [\App\Http\Controllers\OrderController::class, 'success'])->name('orders.success');
});

require __DIR__.'/auth.php';