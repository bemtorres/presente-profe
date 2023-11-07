<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleUserController;

use App\Http\Controllers\ComparteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UsuarioController;

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


  Route::get('chartjs',function(){return view('layouts.chartjs');});

  Route::get('admin/perfil', [HomeController::class, 'perfil'])->name('admin.perfil');
  Route::put('admin/perfil', [HomeController::class, 'perfilUpdate'])->name('admin.perfil');

  Route::resource('admin/usuarios', UsuarioController::class);
  Route::get('admin/usuarios/{id}/sedes', [UsuarioController::class, 'sedes'])->name('usuarios.sedes');
  Route::put('admin/usuarios/{id}/sedes', [UsuarioController::class, 'sedesUpdate'])->name('usuarios.sedes');
});
