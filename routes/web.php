<?php

use App\Http\Controllers\AirplaneController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DestinyController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\TicketController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group([
        'as' => 'admin.',
        'prefix' => 'admin'
    ], function() {
        Route::resource('destinos', DestinyController::class, [
            'except' => ['show'],
        ]);
    
        Route::resource('avioes', AirplaneController::class, [
            'except' => ['show'],
        ]);
    
        Route::resource('voos', FlightController::class, [
            'except' => ['show'],
        ]);

        Route::resource('passagens', TicketController::class, [
            'except' => ['show'],
        ]);
    });
});
