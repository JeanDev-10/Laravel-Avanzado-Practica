<?php

use App\Http\Controllers\v2\UserController;
use App\Http\Controllers\v2\PostController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users',UserController::class)->only('index','show','store');
Route::apiResource('posts',PostController::class)->only('index','show','store');
