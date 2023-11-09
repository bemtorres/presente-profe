<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleUserController;
use App\Http\Controllers\Admin\SedeController;
use App\Http\Controllers\Admin\SemestreController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\UtilsController;

use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('root');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::any('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('auth/google', [GoogleUserController::class, 'redirectToGoogle' ]);
Route::get('auth/google/callback', [GoogleUserController::class, 'handleGoogleCallback' ]);

Route::middleware('auth.user')->group( function () {
  Route::get('home', [HomeController::class, 'index'])->name('home.index');
  Route::post('home', [HomeController::class, 'indexPost'])->name('home');
  Route::get('tutoriales', [HomeController::class, 'tutorial'])->name('home.tutorial');


  Route::get('admin/perfil', [HomeController::class, 'perfil'])->name('admin.perfil');
  Route::put('admin/perfil', [HomeController::class, 'perfilUpdate'])->name('admin.perfil');

  Route::resource('admin/usuarios', UsuarioController::class);
  Route::get('admin/usuarios/{id}/sedes', [UsuarioController::class, 'sedes'])->name('usuarios.sedes');
  Route::put('admin/usuarios/{id}/sedes', [UsuarioController::class, 'sedesUpdate'])->name('usuarios.sedes');

  Route::resource('admin/sedes', SedeController::class);
  Route::get('admin/sedes/{id}/salas', [SedeController::class, 'salas'])->name('sedes.sala');

  Route::resource('admin/sedes', SedeController::class);
  Route::get('admin/utils', [UtilsController::class, 'index'])->name('utils.index');
  Route::get('admin/utils/calendario', [UtilsController::class, 'calendario'])->name('utils.calendario');
  Route::post('admin/utils/calendario', [UtilsController::class, 'calendarioStore'])->name('utils.calendario');

  Route::get('admin/semestres', [SemestreController::class, 'index'])->name('semestres.index');
  Route::get('admin/semestres/{periodo}', [SemestreController::class, 'show'])->name('semestres.show');

  Route::get('admin/solicitud', [SolicitudController::class, 'index'])->name('solicitud.index');
  Route::get('admin/me-solicitudes', [SolicitudController::class, 'meindex'])->name('solicitud.me');

  Route::get('admin/solicitud/{id}', [SolicitudController::class, 'show'])->name('solicitud.show');

});
