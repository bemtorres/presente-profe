<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\API\APIAsignaturaController;
use App\Http\Controllers\API\APIAsistenciaController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EspacioController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::any('correo', [EmailController::class, 'index']);

Route::get('/', [AuthController::class, 'index'])->name('root');
Route::any('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');

Route::get('registro', [AuthController::class, 'registro'])->name('auth.registro');
Route::post('registro', [AuthController::class, 'registroStore'])->name('auth.registro');


Route::get('api/v1/global_asignatura', [APIAsignaturaController::class, 'index'])->name('api.global_asignatura.index');
Route::get('api/v1/global_asignatura/{siglas}', [APIAsignaturaController::class, 'show'])->name('api.global_asignatura.show');
Route::get('api/v1/asistencia/{siglas}', [APIAsistenciaController::class, 'show'])->name('api.asistencia.show');




// Route::get('recuperar', [AuthController::class, 'recuperar'])->name('recuperar');
// Route::post('recuperar', [AuthController::class, 'recuperarStore'])->name('recuperar');


// Route::get('auth/google', [GoogleUserController::class, 'redirectToGoogle' ]);
// Route::get('auth/google/callback', [GoogleUserController::class, 'handleGoogleCallback' ]);

Route::middleware('auth.user')->group( function () {
  // ADMIN
  Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
  Route::resource('admin/usuarios', UsuarioController::class)->names('admin.usuario');
  Route::get('admin/usuarios_premium', [UsuarioController::class, 'indexPremium' ])->name('admin.usuario.premium');
  Route::get('admin/usuarios_normal', [UsuarioController::class, 'indexNormal'])->name('admin.usuario.normal');
  Route::put('admin/usuarios/{id}/password', [UsuarioController::class, 'updatePassword'])->name('admin.usuario.password');
  Route::put('admin/usuarios/{id}/img', [UsuarioController::class, 'updateImg'])->name('admin.usuario.img');


  Route::resource('admin/espacios', EspacioController::class)->names('admin.espacio');

  // PERFIL
  Route::get('admin/perfil', [PerfilController::class, 'index'])->name('admin.perfil.index');
  Route::put('admin/perfil', [PerfilController::class, 'update'])->name('admin.perfil.update');
  Route::put('admin/perfil/password', [PerfilController::class, 'updatePassword'])->name('admin.perfil.password');
  Route::put('admin/perfil/img', [PerfilController::class, 'updateImg'])->name('admin.perfil.img');
  Route::get('admin/perfil/invitar', [PerfilController::class, 'invitar'])->name('admin.perfil.invitar');
  Route::put('admin/perfil/invitar', [PerfilController::class, 'invitarUpdate'])->name('admin.perfil.invitar');
  Route::put('admin/perfil/codigo', [PerfilController::class, 'codigoUpdate'])->name('admin.perfil.codigo');


  // APP
  Route::get('app', [AppController::class, 'index'])->name('app.index');

});
