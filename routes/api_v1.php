<?php

use App\Http\Controllers\v1\UserController;
use App\Http\Controllers\v1\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('users',UserController::class)->only('index','show','store');
Route::apiResource('posts',PostController::class)->only('index','show','store');
