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
use App\Http\Controllers\WebappAlumnoController;
use App\Http\Controllers\WebappDocenteController;
use Illuminate\Support\Facades\Route;

Route::any('correo', [EmailController::class, 'index']);

Route::get('/', [AuthController::class, 'index'])->name('root');
Route::any('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');

Route::get('auth/registro', [AuthController::class, 'registro'])->name('auth.registro');
Route::post('auth/registro', [AuthController::class, 'registroStore'])->name('auth.registro');

Route::get('auth/recuperar', [AuthController::class, 'recuperar'])->name('auth.recuperar');
Route::post('auth/recuperar', [AuthController::class, 'recuperarStore'])->name('auth.recuperar');



Route::get('api/v1/global_asignatura', [APIAsignaturaController::class, 'index'])->name('api.global_asignatura.index');
Route::get('api/v1/global_asignatura/{siglas}', [APIAsignaturaController::class, 'show'])->name('api.global_asignatura.show');
Route::get('api/v1/asistencia/{siglas}', [APIAsistenciaController::class, 'show'])->name('api.asistencia.show');


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
  Route::get('admin/espacios/{id}/compartir', [EspacioController::class,'compartir'])->name('admin.espacio.compartir');
  Route::get('admin/espacios/{id}/matricula', [EspacioController::class,'matricula'])->name('admin.espacio.matricula');
  Route::get('admin/espacios/{id}/clases', [EspacioController::class,'clases'])->name('admin.espacio.clases');
  Route::post('admin/espacios/{id}/clases', [EspacioController::class,'clasesStore'])->name('admin.espacio.clases');
  Route::post('admin/espacios/{id}/clases/{id_clases}', [EspacioController::class,'clasesShow'])->name('admin.espacio.clases.show');

 // API INTERNA
  Route::put('admin/espacios/{id}/matricula/active', [EspacioController::class,'matriculaActive'])->name('admin.espacio.matricla.active');
  //

  // PERFIL
  Route::get('admin/perfil', [PerfilController::class, 'index'])->name('admin.perfil.index');
  Route::put('admin/perfil', [PerfilController::class, 'update'])->name('admin.perfil.update');
  Route::put('admin/perfil/password', [PerfilController::class, 'updatePassword'])->name('admin.perfil.password');
  Route::put('admin/perfil/img', [PerfilController::class, 'updateImg'])->name('admin.perfil.img');
  Route::get('admin/perfil/invitar', [PerfilController::class, 'invitar'])->name('admin.perfil.invitar');
  Route::put('admin/perfil/invitar', [PerfilController::class, 'invitarUpdate'])->name('admin.perfil.invitar');
  Route::put('admin/perfil/codigo', [PerfilController::class, 'codigoUpdate'])->name('admin.perfil.codigo');


  // CALENDAIRO
  Route::get('admin/calendario', [AdminController::class, 'calendario'])->name('admin.calendario.index');


  // APP DOCENTE
  Route::get('webapp-docente', [WebappDocenteController::class, 'index'])->name('webappdocente.index');
  Route::post('webapp-docente/espacios', [WebappDocenteController::class, 'espaciosStore'])->name('webappdocente.espacios.store');
  Route::get('webapp-docente/espacios/{id}', [WebappDocenteController::class, 'espaciosShow'])->name('webappdocente.espacios.show');
  Route::get('webapp-docente/espacios/{id}/edit', [WebappDocenteController::class, 'espaciosEdit'])->name('webappdocente.espacios.edit');
  Route::put('webapp-docente/espacios/{id}/edit', [WebappDocenteController::class, 'espaciosUpdate'])->name('webappdocente.espacios.update');
  Route::get('webapp-docente/espacios/{id}/matricula', [WebappDocenteController::class, 'matriculaIndex'])->name('webappdocente.espacios.matricula.index');
  Route::get('webapp-docente/espacios/{id}/anuncios', [WebappDocenteController::class, 'anunciosShow'])->name('webappdocente.espacios.anuncio');
  Route::post('webapp-docente/espacios/{id}/anuncios', [WebappDocenteController::class, 'anunciosStore'])->name('webappdocente.espacios.anuncio.store');
  Route::get('webapp-docente/espacios/{id}/clases', [WebappDocenteController::class, 'clasesIndex'])->name('webappdocente.espacios.clases');
  Route::get('webapp-docente/espacios/{id}/clases-calendario', [WebappDocenteController::class, 'clasesCalendarioShow'])->name('webappdocente.espacios.clases-calendario');
  Route::post('webapp-docente/espacios/{id}/clases', [WebappDocenteController::class, 'clasesStore'])->name('webappdocente.clases.store');
  Route::get('webapp-docente/espacios/{id}/clases/{id_c}', [WebappDocenteController::class, 'clasesShow'])->name('webappdocente.espacios.clases.show');

  // APP
  Route::get('webapp-alumno', [WebappAlumnoController::class, 'index'])->name('webappalumno.index');



 ;


});
Route::get('api/v1/cursos', [AppController::class, 'cursos']);
Route::get('api/v1/cursos', [AppController::class, 'cursos']);
