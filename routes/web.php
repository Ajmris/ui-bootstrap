<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', [App\Http\Controllers\HelloWorldController::class, 'show']);
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
Route::get('/users/list', [App\Http\Controllers\UserController::class, 'index'])->middleware('auth');
Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');