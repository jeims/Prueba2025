<?php

use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('principal');
    });

    Route::get('/home', [HomeController::class, 'index'])->name('home.index');


    Route::post('/expedientes', [ExpedienteController::class, 'store'])->name('expedientes');

    Route::put('/expedientes', [ExpedienteController::class, 'update'])->name('expedientes.update');

    Route::delete('/expedientes/{id}/soft-delete', [ExpedienteController::class, 'softDelete'])->name('expedientes.softDelete');

    Route::get('/expedientes', [ExpedienteController::class, 'show'])->name('expedientes.buscar');

    Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

});

Route::get('/registro', [RegistroController::class, 'index'])->name('registro');
Route::post('/registro', [RegistroController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

