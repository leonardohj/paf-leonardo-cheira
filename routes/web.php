<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GramsController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\FeederController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Models\Feeder;

Route::get('/landing-page', function (){
    return view('landing-page.landing');
})->name('landing');
Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');

Route::post('/register' ,[AuthController::class, 'register'])->name('register');
Route::post('/login' ,[AuthController::class, 'login'])->name('login');
Route::post('/logout' ,[AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function (){
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::post('/changeVariables', [GramsController::class, 'store'])->name('changeVariables');
    Route::get('/feeder', [FeederController::class, 'index'])->name('feeder');
    Route::post('/feeder/show', [FeederController::class, 'show'])->name('feeder.show');
    Route::post('/feeder', [FeederController::class, 'store'])->name('feeder.create');
    Route::post('/feeder/link', [FeederController::class, 'linkingFeederUser'])->name('feeder.linkUser');
    Route::post('/feeder/activate/{feeder}', [FeederController::class, 'activate'])->name('feeder.activate');
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
    Route::post('/schedule/store/{feeder}', [ScheduleController::class, 'store'])->name('schedule.store');
});

Route::get('/api/schedule', [ApiController::class, 'GetSchedules'])->name('api.schedule');
Route::get('/api/feeder', [ApiController::class, 'GetFeeders'])->name('api.schedule');

Route::post('/api/schedule', [ApiController::class, 'store'])->name('api.schedule');


Route::get('/admin', function(){
    $feeders = Feeder::all();
    return view('admin.index', compact('feeders'));
});

Route::fallback(function () {
    return view('404');
});