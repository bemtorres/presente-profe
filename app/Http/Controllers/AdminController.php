<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClaseEspacio;
use Illuminate\Http\Request;


class AdminController extends Controller
{
  public function index() {
    return view('admin.index');
  }

  public function calendario() {
    $calendarios = ClaseEspacio::where('id_usuario', current_user()->id)->get();

    // $calendarios = $calendarios->map(function($calendario) {
    //   $calendario->start = $calendario->fecha_inicio;
    //   $calendario->end = $calendario->fecha_fin;
    //   $calendario->title = $calendario->nombre;
    //   return $calendario;
    // });

    return view('admin.calendario', compact('calendarios'));
  }

}
