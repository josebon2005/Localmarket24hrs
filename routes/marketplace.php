<?php

use App\Http\Controllers\Marketplace\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('marketplace.home');

Route::get('/comercios/{commerce}', [HomeController::class, 'show'])
    ->name('marketplace.commerces.show');
