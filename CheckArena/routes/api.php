<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PartieDataController;
use App\Http\Controllers\DashController;

use APP\Services\SavePatrieServices;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// use Illuminate\Support\Facades\Log;

Route::post('/partie', [PartieDataController::class, 'savePartieData']);


Route::get('/getHistory/{id}/{num}', [DashController::class, 'fetchingData']);

Route::post('/filterdData', [DashController::class, 'filterdData']);

