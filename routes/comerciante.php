<?php

use App\Http\Controllers\Comerciante\CommerceController;
use App\Http\Controllers\Comerciante\ConversationController;
use App\Http\Controllers\Comerciante\CouponController;
use App\Http\Controllers\Comerciante\OrderController;
use App\Http\Controllers\Comerciante\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'active'])
    ->prefix('comerciante')
    ->name('comerciante.')
    ->group(function () {
        Route::get('/crear-comercio', [CommerceController::class, 'create'])->name('commerce.create');
        Route::post('/crear-comercio', [CommerceController::class, 'store'])->name('commerce.store');

        Route::get('/dashboard', function () {
            return view('comerciante.dashboard');
        })->name('dashboard');

        Route::get('/productos', [ProductController::class, 'index'])->name('products.index');
        Route::get('/productos/crear', [ProductController::class, 'create'])->name('products.create');
        Route::post('/productos', [ProductController::class, 'store'])->name('products.store');
        Route::get('/productos/{product}/editar', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/productos/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/productos/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::patch('/productos/{product}/estado', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');

        Route::get('/cupones', [CouponController::class, 'index'])->name('coupons.index');
        Route::get('/cupones/crear', [CouponController::class, 'create'])->name('coupons.create');
        Route::post('/cupones', [CouponController::class, 'store'])->name('coupons.store');
        Route::get('/cupones/{coupon}/editar', [CouponController::class, 'edit'])->name('coupons.edit');
        Route::put('/cupones/{coupon}', [CouponController::class, 'update'])->name('coupons.update');
        Route::delete('/cupones/{coupon}', [CouponController::class, 'destroy'])->name('coupons.destroy');
        Route::patch('/cupones/{coupon}/estado', [CouponController::class, 'toggleStatus'])->name('coupons.toggle-status');

        Route::get('/chats', [ConversationController::class, 'index'])->name('conversations.index');
        Route::get('/chats/{conversation}', [ConversationController::class, 'show'])->name('conversations.show');
        Route::post('/chats/{conversation}/mensajes', [ConversationController::class, 'storeMessage'])->name('conversations.messages.store');

        Route::get('/pedidos', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/pedidos/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::patch('/pedidos/{order}/estado', [OrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::patch('/pedidos/{order}/repartidor', [OrderController::class, 'assignDelivery'])->name('orders.assign-delivery');
    });
