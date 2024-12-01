<?php

use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\MateriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('materias', MateriaController::class)->only('store');
