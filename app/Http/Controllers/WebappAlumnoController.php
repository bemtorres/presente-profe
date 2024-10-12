<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Espacio;

class WebappAlumnoController extends Controller
{
  public function index() {
    $espacios = Espacio::get();

    return view('app.index', compact('espacios'));
  }
}
