<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleUserController;

use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UsuarioController;

use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('root');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::any('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('auth/google', [GoogleUserController::class, 'redirectToGoogle' ]);
Route::get('auth/google/callback', [GoogleUserController::class, 'handleGoogleCallback' ]);

Route::middleware('auth.user')->group( function () {
  Route::get('home', [HomeController::class, 'index'])->name('home.index');
  Route::resource('asignaturas', AsignaturaController::class);

  Route::resource('usuarios', UsuarioController::class);
  Route::resource('planes', PlanController::class);
  Route::get('planes/{id}/inscritos', [PlanController::class, 'inscritos'])->name('planes.inscritos');
  Route::get('planes/{id}/inscribir', [PlanController::class, 'inscribir'])->name('planes.inscribir');
  Route::get('planes/{id}/compartir', [PlanController::class, 'compartir'])->name('planes.compartir');


});

