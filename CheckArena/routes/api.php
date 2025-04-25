<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


use Illuminate\Support\Facades\Log;

Route::post('/partie', function (Request $request) {

  Log::info('🟢 TEST: Partie works!' , $request->all());

  return response()->json(['message' => 'Success'], 200);

});
