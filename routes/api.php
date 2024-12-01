<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('posts', PostController::class)->only('index','show','store');
Route::apiResource('users', UserController::class)->only('index','show','store');
