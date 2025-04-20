<?php

use Illuminate\Support\Facades\Route;

Route::get('/auth', ['App\Http\Controllers\AuthController', 'index']);

Route::post('/login', ['App\Http\Controllers\AuthController', 'logIn']);

Route::post('/register', ['App\Http\Controllers\AuthController', 'register']);

Route::get('/',['App\Http\Controllers\HomeController', 'index']);


Route::get('/play',['App\Http\Controllers\GameController', 'index']);
