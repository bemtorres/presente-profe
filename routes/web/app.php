<?php

use App\Http\Controllers\App\AppController;
use Illuminate\Support\Facades\Route;

// rutas solo app



// Route::middleware('auth.device')->group( function () {
  Route::get('device', [AppController::class, 'index'])->name('app.index');

// });
