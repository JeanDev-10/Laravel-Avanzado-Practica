<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('throttle:5,1')->group(function () {
    Route::group(['middleware' => ["auth:sanctum"]], function () {
        //rutas
        Route::get('user-profile', [AuthController::class, 'userProfile']);
        Route::get('logout', [AuthController::class, 'logout']);
    });
});

Route::middleware('throttle:5,1')->group(function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});
