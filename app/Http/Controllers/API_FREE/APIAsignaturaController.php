<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\GlobalAsignatura;
use Illuminate\Http\Request;

class APIAsignaturaController extends Controller
{

  public function index() {
    $a = GlobalAsignatura::get();
    // $a = GlobalAsignatura::with('semanas')->get();

    return response()->json($a);
  }

  public function show($siglas) {
    // $a = GlobalAsignatura::where('siglas', $siglas)->with('semanas')->first();
    $a = GlobalAsignatura::where('siglas', $siglas)->first();

    return response()->json($a);
  }
}
