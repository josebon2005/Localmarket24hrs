<?php

use App\Http\Controllers\Marketplace\CartController;
use App\Http\Controllers\Marketplace\ConversationController;
use App\Http\Controllers\Marketplace\HomeController;
use App\Http\Controllers\Marketplace\OrderController;
use App\Http\Controllers\Marketplace\SiteRatingController;
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
    Route::post('/carrito/cupon', [CartController::class, 'applyCoupon'])->name('marketplace.cart.coupon.apply');
    Route::delete('/carrito/cupon', [CartController::class, 'removeCoupon'])->name('marketplace.cart.coupon.remove');

    Route::get('/mis-pedidos', [OrderController::class, 'index'])->name('marketplace.orders.index');
    Route::get('/mis-pedidos/{order}', [OrderController::class, 'show'])->name('marketplace.orders.show');
    Route::patch('/mis-pedidos/{order}/repartidor', [OrderController::class, 'assignDelivery'])->name('marketplace.orders.assign-delivery');
    Route::post('/pedidos/confirmar', [OrderController::class, 'store'])->name('marketplace.orders.store');
    Route::post('/valoraciones', [SiteRatingController::class, 'store'])->name('marketplace.site-ratings.store');

    Route::get('/chats', [ConversationController::class, 'index'])->name('marketplace.conversations.index');
    Route::post('/comercios/{commerce}/chat', [ConversationController::class, 'start'])->name('marketplace.conversations.start');
    Route::get('/chats/{conversation}', [ConversationController::class, 'show'])->name('marketplace.conversations.show');
    Route::post('/chats/{conversation}/mensajes', [ConversationController::class, 'storeMessage'])->name('marketplace.conversations.messages.store');
});
