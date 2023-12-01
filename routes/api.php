<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::apiResource('cars', CarController::class)
    ->except('show');

Route::delete('/cars/type/{type}', [CarController::class, 'destroyByType']);
