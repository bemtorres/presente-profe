<?php

use App\Http\Controllers\API\Backend\APICalendarioController;
use App\Http\Controllers\API\Backend\APISolicitudController;
use App\Http\Controllers\API\Backend\APIUsuarioController;
use App\Http\Controllers\App\AppController;
use Illuminate\Support\Facades\Route;

// rutas solo app



// Route::middleware('auth.device')->group( function () {
Route::middleware('auth.user')->group( function () {
  Route::get('app', [AppController::class, 'index'])->name('app.index');
  Route::get('appgo', [AppController::class, 'appgo'])->name('app.sede.appgo');
  Route::get('app/{id_sede}/calendario', [AppController::class, 'indexUserSede'])->name('app.sede.usuario');
  Route::get('app/{id_sede}', [AppController::class, 'indexSede'])->name('app.sede');
  Route::get('app2', [AppController::class, 'index2'])->name('app.index2');


  Route::get('api/backend/usuario', [APIUsuarioController::class, 'index'])->name('api.backend.usuario.index');
  Route::post('api/backend/usuario', [APIUsuarioController::class, 'buscar'])->name('api.backend.usuario.buscar');


  // solos los registros validos
  Route::post('api/backend/calendario', [APICalendarioController::class, 'buscar'])->name('api.backend.calendario.buscar');
  // todos los registro
  Route::post('api/backend/calendario-all', [APICalendarioController::class, 'buscarAll'])->name('api.backend.calendario.buscar.all');

  Route::post('api/backend/calendario/new', [APICalendarioController::class, 'store'])->name('api.backend.calendario.store');

  Route::post('api/backend/app/solicitud', [APISolicitudController::class, 'store'])->name('api.backend.solicitud.store');
});
