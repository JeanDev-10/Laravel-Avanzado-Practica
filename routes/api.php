<?php

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('users', [UserController::class, 'index'])->middleware('permission:index.usuarios');
    Route::post('users', [UserController::class, 'store'])->middleware('permission:store.usuarios');
    Route::get('users/{user}', [UserController::class, 'show'])->middleware('permission:show.usuarios');
    Route::put('users/{user}', [UserController::class, 'update'])->middleware('permission:update.usuarios');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware('permission:destroy.usuarios');

    Route::get('libros', [LibroController::class, 'index'])->middleware('permission:index.libros');
    Route::post('libros', [LibroController::class, 'store'])->middleware('permission:store.libros');
    Route::get('libros/{libro}', [LibroController::class, 'show'])->middleware('permission:show.libros');
    Route::put('libros/{libro}', [LibroController::class, 'update'])->middleware('permission:update.libros');
    Route::delete('libros/{libro}', [LibroController::class, 'destroy'])->middleware('permission:destroy.libros');
});
Route::post('/login/google', [GoogleAuthController::class, 'loginWithGoogle']);
Route::post('login', [UserController::class, 'login']);
