<?php

use App\Http\Controllers\ConversorController;

Route::get('/', function () {
    return view('conversor');
});

Route::post('/converte-romano', [ConversorController::class, 'converteRomano']);
Route::post('/converte-real', [ConversorController::class, 'converteReal']);