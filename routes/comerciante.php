<?php

use App\Http\Controllers\Comerciante\CommerceController;
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
    });
