<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', ['App\Http\Controllers\AuthController', 'index'])->name('login');

Route::post('/userLogin', ['App\Http\Controllers\AuthController', 'logIn']);

Route::post('/userRegister', ['App\Http\Controllers\AuthController', 'register']);

Route::get('/logout', ['App\Http\Controllers\AuthController', 'logout']);




Route::get('/',['App\Http\Controllers\HomeController', 'index']);



Route::middleware('auth:sanctum')->get('/play', [App\Http\Controllers\GameController::class, 'index']);

