<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleUserController;

use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\DisponibilidadHorarioController;
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
  Route::get('admin/perfil', [HomeController::class, 'perfil'])->name('admin.perfil');
  Route::put('admin/perfil', [HomeController::class, 'perfilUpdate'])->name('admin.perfil');

  Route::get('dh/{id}', [DisponibilidadHorarioController::class, 'show'])->name('disponibilidad.show');
  Route::get('dh/{id}/asignaturas', [DisponibilidadHorarioController::class, 'asignaturas'])->name('disponibilidad.asignaturas');
  Route::get('dh/{id}/asignaturas/create', [DisponibilidadHorarioController::class, 'asignaturasCreate'])->name('disponibilidad.asignaturas.create');
  Route::post('dh/{id}/asignaturas', [DisponibilidadHorarioController::class, 'asignaturasStore'])->name('disponibilidad.asignaturas.store');

  Route::get('dh/{id}/calendario', [DisponibilidadHorarioController::class, 'calendario'])->name('disponibilidad.calendario');
  Route::post('dh/{id}/calendario', [DisponibilidadHorarioController::class, 'apiAsignaturaStore'])->name('disponibilidad.calendario.store');


// ADMIN
  Route::resource('asignaturas', AsignaturaController::class);
  Route::resource('usuarios', UsuarioController::class);
  Route::resource('planes', PlanController::class);
  Route::get('planes/{id}/participantes', [PlanController::class, 'participantes'])->name('planes.participantes');
  Route::put('planes/{id}/participantes', [PlanController::class, 'participantesUpdate'])->name('planes.participantes');
  Route::get('planes/{id}/participantes/add', [PlanController::class, 'participantesAdd'])->name('planes.participantesAdd');
  Route::get('planes/{id}/compartir', [PlanController::class, 'compartir'])->name('planes.compartir');
  Route::get('planes/{id}/asignaturas', [PlanController::class, 'asignaturas'])->name('planes.asignaturas');
  Route::put('planes/{id}/asignaturas', [PlanController::class, 'asignaturasUpdate'])->name('planes.asignaturas');
  Route::get('planes/{id}/asignaturas/add', [PlanController::class, 'asignaturasAdd'])->name('planes.asignaturasAdd');

  // @API
  Route::put('api/v0/planes/{id}/asignaturas/change_position', [PlanController::class, 'apiAsignaturaChangePosition'])->name('api.interna.asignatura.changePosition');

  // me
  Route::put('api/v0/planes/{id}/measignaturas/change_position', [DisponibilidadHorarioController::class, 'apiAsignaturaChangePosition'])->name('api.interna.measignatura.changePosition');
});

