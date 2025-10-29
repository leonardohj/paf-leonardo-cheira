<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GramsController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\FeederController;


Route::get('/', [GramsController::class, 'index'])->name('home');
Route::post('/changeVariables', [GramsController::class, 'store'])->name('changeVariables');
Route::get('/feeder', [FeederController::class, 'index'])->name('feeder');
Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
Route::get('/landing-page', function (){
    return view('landing');
});