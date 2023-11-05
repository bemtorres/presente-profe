<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use App\Models\Semestre;
use Illuminate\Http\Request;

class SemestreController extends Controller
{
  public function index() {
    $semestres = Semestre::get();

    $s = Semestre::where('activo', true)->first();

    return view('admin.semestre.index', compact('semestres', 's'));
  }

  public function show($periodo) {
    $s = Semestre::where('periodo',$periodo)->with('semanas')->first();


    return view('admin.semestre.show', compact('s'));
  }
}
