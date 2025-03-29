<?php

use App\Http\Controllers\InteresesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [InteresesController::class, 'index'])->name('intereses.index');
Route::post('/calcular', [InteresesController::class, 'calcular'])->name('calcular.intereses');
