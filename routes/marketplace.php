<?php

use App\Http\Controllers\Marketplace\CartController;
use App\Http\Controllers\Marketplace\HomeController;
use App\Http\Controllers\Marketplace\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('marketplace.home');

Route::get('/comercios/{commerce}', [HomeController::class, 'show'])
    ->name('marketplace.commerces.show');

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/carrito', [CartController::class, 'index'])->name('marketplace.cart.index');
    Route::post('/carrito/agregar/{product}', [CartController::class, 'add'])->name('marketplace.cart.add');
    Route::patch('/carrito/items/{cartItem}', [CartController::class, 'update'])->name('marketplace.cart.update');
    Route::delete('/carrito/items/{cartItem}', [CartController::class, 'destroy'])->name('marketplace.cart.destroy');
    Route::delete('/carrito/vaciar', [CartController::class, 'clear'])->name('marketplace.cart.clear');

    Route::get('/mis-pedidos', [OrderController::class, 'index'])->name('marketplace.orders.index');
    Route::get('/mis-pedidos/{order}', [OrderController::class, 'show'])->name('marketplace.orders.show');
    Route::post('/pedidos/confirmar', [OrderController::class, 'store'])->name('marketplace.orders.store');
});
