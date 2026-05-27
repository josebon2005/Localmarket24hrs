<?php

use App\Http\Controllers\Repartidor\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'active', 'delivery'])
    ->prefix('repartidor')
    ->name('repartidor.')
    ->group(function () {
        Route::get('/dashboard', [OrderController::class, 'index'])->name('dashboard');
        Route::get('/pedidos/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::patch('/pedidos/{order}/estado', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    });
