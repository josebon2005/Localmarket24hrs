<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommerceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::patch('/categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');

        Route::get('/admin-users/create', [AdminUserController::class, 'create'])->name('admin-users.create');
        Route::post('/admin-users', [AdminUserController::class, 'store'])->name('admin-users.store');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/ban', [UserController::class, 'ban'])->name('users.ban');
        Route::patch('/users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/commerces', [CommerceController::class, 'index'])->name('commerces.index');
        Route::patch('/commerces/{commerce}/suspend', [CommerceController::class, 'suspend'])->name('commerces.suspend');
        Route::patch('/commerces/{commerce}/activate', [CommerceController::class, 'activate'])->name('commerces.activate');
        Route::patch('/commerces/{commerce}/deactivate', [CommerceController::class, 'deactivate'])->name('commerces.deactivate');
        Route::delete('/commerces/{commerce}', [CommerceController::class, 'destroy'])->name('commerces.destroy');

        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });
