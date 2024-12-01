<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('posts')->group(function () {
    Route::post('{id}/tags', [PostController::class, 'addTags']);
    Route::get('{id}/tags', [PostController::class, 'getTags']);
});

Route::prefix('videos')->group(function () {
    Route::post('{id}/tags', [VideoController::class, 'addTags']);
    Route::get('{id}/tags', [VideoController::class, 'getTags']);
});

Route::prefix('tags')->group(function () {
    Route::get('{id}', [TagController::class, 'show']);
});
