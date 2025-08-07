<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', [App\Http\Controllers\HelloWorldController::class, 'show']);
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');

Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index')->middleware('auth');
Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create')->middleware('auth');
Route::post('/product', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store')->middleware('auth');
Route::get('/product/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show')->middleware('auth');
Route::get('/product/edit/{product}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit')->middleware('auth');
Route::post('/product/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update')->middleware('auth');
Route::delete('/product/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy')->middleware('auth');

Route::get('/users/list', [App\Http\Controllers\UserController::class, 'index'])->middleware('auth');
Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');