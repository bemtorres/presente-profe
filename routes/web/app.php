<?php

use App\Http\Controllers\API\Backend\APICalendarioController;
use App\Http\Controllers\API\Backend\APIUsuarioController;
use App\Http\Controllers\App\AppController;
use Illuminate\Support\Facades\Route;

// rutas solo app



// Route::middleware('auth.device')->group( function () {
Route::middleware('auth.user')->group( function () {
  Route::get('app', [AppController::class, 'index'])->name('app.index');
  Route::get('app/{id_sede}', [AppController::class, 'indexSede'])->name('app.sede');
  Route::get('app2', [AppController::class, 'index2'])->name('app.index2');


  Route::get('api/backend/usuario', [APIUsuarioController::class, 'index'])->name('api.backend.usuario.index');
  Route::post('api/backend/usuario', [APIUsuarioController::class, 'buscar'])->name('api.backend.usuario.buscar');


  Route::post('api/backend/calendario', [APICalendarioController::class, 'buscar'])->name('api.backend.calendario.buscar');
  Route::post('api/backend/calendario/new', [APICalendarioController::class, 'store'])->name('api.backend.calendario.store');

});
