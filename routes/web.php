<?php

use App\Http\Controllers\SupermarketController;

Route::get('/', [SupermarketController::class, 'index']);
Route::post('/report/{id}', [SupermarketController::class, 'report'])->middleware('auth');