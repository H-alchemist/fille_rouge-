<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', ['App\Http\Controllers\AuthController', 'index'])->name('login');

Route::post('/userLogin', ['App\Http\Controllers\AuthController', 'logIn']);

Route::post('/userRegister', ['App\Http\Controllers\AuthController', 'register']);

Route::get('/logout', ['App\Http\Controllers\AuthController', 'logout']);




Route::get('/',['App\Http\Controllers\HomeController', 'index']);


Route::get('/dash',['App\Http\Controllers\DashController', 'index']);

Route::get('/history',['App\Http\Controllers\DashController', 'history']);


Route::get('/review/{id}',['App\Http\Controllers\ReviewController', 'index']);


Route::middleware('auth:sanctum')->get('/play', [App\Http\Controllers\GameController::class, 'index']);


Route::get('/profile', ['App\Http\Controllers\DashController', 'showProfile']);


Route::post('/profile', ['App\Http\Controllers\DashController', 'updateProfile'])->name('profile.update');




