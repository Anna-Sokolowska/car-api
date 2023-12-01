<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::apiResource('cars', CarController::class);
