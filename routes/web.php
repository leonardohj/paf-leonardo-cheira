<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GramsController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\FeederController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/landing-page', function (){
    return view('landing-page.landing');
});
Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');

Route::post('/register' ,[AuthController::class, 'register'])->name('register');
Route::post('/login' ,[AuthController::class, 'login'])->name('login');
Route::post('/logout' ,[AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function (){
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::post('/changeVariables', [GramsController::class, 'store'])->name('changeVariables');
    Route::get('/feeder', [FeederController::class, 'index'])->name('feeder');
    Route::post('/feeder', [FeederController::class, 'store'])->name('feeder.create');
    Route::post('/feeder/link', [FeederController::class, 'linkingFeederUser'])->name('feeder.linkUser');
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
});
