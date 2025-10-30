<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);
Route::get('/dashboard', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

// 🔹 Auth routes muszą być dostępne dla wszystkich zalogowanych użytkowników:
Auth::routes();

Route::middleware(['auth', 'verified'])->group(function () {

    // 🔸 Tylko admin
    Route::middleware(['can:isAdmin'])->group(function () {
        Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
        Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
        Route::post('/product', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
        Route::get('/product/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
        Route::get('/product/edit/{product}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
        Route::post('/product/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
        Route::delete('/product/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');

        Route::get('/users/list', [App\Http\Controllers\UserController::class, 'index']);
        Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy']);
    });

    // 🔹 Wspólne dla wszystkich zalogowanych (admin + user)
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::get('/hello', [App\Http\Controllers\HelloWorldController::class, 'show']);
