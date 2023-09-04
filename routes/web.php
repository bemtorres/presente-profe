<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'index'])->name('root');
Route::get('home', [AuthController::class, 'home'])->name('home');
