<?php

use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'index'])->name('root');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::any('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth.user')->group( function () {
  Route::get('home', [HomeController::class, 'index'])->name('home.index');
  Route::resource('asignaturas', AsignaturaController::class);

  Route::resource('usuarios', UsuarioController::class);


});

