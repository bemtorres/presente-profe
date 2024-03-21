<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\API\APIAsignaturaController;
use App\Http\Controllers\API\APIAsistenciaController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

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


  // APP
  Route::get('app', [AppController::class, 'index'])->name('app.index');

});
