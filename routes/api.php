<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('posts')->group(function () {
    Route::get('{id}', [PostController::class, 'show']);
    Route::post('{id}/comments', [PostController::class, 'addComment']);
});

Route::prefix('videos')->group(function () {
    Route::get('{id}', [VideoController::class, 'show']);
    Route::post('{id}/comments', [VideoController::class, 'addComment']);
});

Route::prefix('comments')->group(function () {
    Route::get('/', [CommentController::class, 'index']);
    Route::get('{id}', [CommentController::class, 'show']);
});
