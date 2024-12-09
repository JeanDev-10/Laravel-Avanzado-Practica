<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Schedule::command('users:notify-inactive')
    ->everyMinute() // Ejecutar cada minuto
    ->withoutOverlapping() // Evita que se ejecuten múltiples instancias simultáneamente
    ->onFailure(function () {
        Log::error('Failed to notify inactive users.');
    });
