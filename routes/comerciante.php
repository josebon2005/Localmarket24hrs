<?php

use App\Http\Controllers\Comerciante\CommerceController;
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
    });
