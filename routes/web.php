<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GramsController;


Route::get('/', [GramsController::class, 'index'])->name('home');

Route::post('/changeVariables', [GramsController::class, 'store'])->name('changeVariables');