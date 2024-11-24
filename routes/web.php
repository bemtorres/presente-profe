<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\API\v1\AuthController as V1AuthController;
use App\Http\Controllers\API\v1\CursoController as V1CursoController;
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

// Route::get('auth/google', [GoogleUserController::class, 'redirectToGoogle' ]);
// Route::get('auth/google/callback', [GoogleUserController::class, 'handleGoogleCallback' ]);

Route::middleware('auth.user')->group( function () {
  Route::get('home', [AdminController::class, 'home'])->name('homeee');

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
  Route::post('webapp-alumno/matricula', [WebappAlumnoController::class, 'matriculaStore'])->name('webappalumno.matricula.store');
  Route::post('webapp-alumno/registro', [WebappAlumnoController::class, 'registroStore'])->name('webappalumno.registro.store');
  Route::get('webapp-alumno/curso/{m_id}/historial', [WebappAlumnoController::class, 'historial'])->name('webappalumno.historial');

  Route::post('webapp-alumno/reporte', [WebappAlumnoController::class, 'reporteStore'])->name('webappalumno.reporte.store');

});

// API


Route::post('api/v1/auth', [V1AuthController::class, 'login']);
Route::post('api/v1/auth/recuperar', [V1AuthController::class, 'recuperar']);
Route::get('api/v1/auth/me', [V1AuthController::class, 'me']);
Route::post('api/v1/usuarios', [V1AuthController::class, 'store']);
Route::put('api/v1/usuarios/password', [V1AuthController::class, 'updatePassword']);
// Route::put('api/v1/usuarios', [V1AuthController::class, 'updatePassword']);

Route::get('api/v1/cursos', [V1CursoController::class, 'index']);
Route::post('api/v1/cursos', [V1CursoController::class, 'store']);
Route::get('api/v1/cursos/{id}', [V1CursoController::class, 'show']);
Route::get('api/v1/cursos/{id}/inasistencias', [V1CursoController::class, 'inasistencias']);
Route::get('api/v1/cursos/{id}/anuncios', [V1CursoController::class, 'anuncios']);
Route::post('api/v1/cursos/{id}/anuncios', [V1CursoController::class, 'anunciosStore']);



Route::get('api/v1/cursos/{id}/clase', [V1CursoController::class, 'clasesIndex']);
Route::post('api/v1/cursos/{id}/clase', [V1CursoController::class, 'clasesStore']);
Route::get('api/v1/cursos/{id}/clase/{code}', [V1CursoController::class, 'clasesAsistentes']);


Route::get('api/v1/estudiante/cursos/{id}/anuncios', [V1CursoController::class, 'anunciosEstudiante']);
Route::get('api/v1/estudiante/cursos', [V1CursoController::class, 'misCursos']);
Route::get('api/v1/estudiante/cursos/{id}', [V1CursoController::class, 'misCursoAsistencia']);
Route::post('api/v1/estudiante/cursos/{id}/reportar-inasistencia', [V1CursoController::class, 'reportarInasistencia']);

Route::post('api/v1/clases/{code}/asistencia', [V1CursoController::class, 'asistenciaStore']);

// Route::middleware('auth:sanctum')->get('api/v1/cursos', [V1CursoController::class, 'index']);

// Route::get('auth/registro', [AuthController::class, 'registro'])->name('auth.registro');
// Route::post('auth/registro', [AuthController::class, 'registroStore'])->name('auth.registro');

// Route::get('auth/recuperar', [AuthController::class, 'recuperar'])->name('auth.recuperar');
// Route::post('auth/recuperar', [AuthController::class, 'recuperarStore'])->name('auth.recuperar');
