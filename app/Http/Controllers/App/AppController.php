<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use App\Services\DuocHorario;
use Illuminate\Http\Request;

class AppController extends Controller
{

  public function index() {
    $my_horario = [];
    $horarios = DuocHorario::TIMES;

    $sedes = Sede::get();

    return view('app.index', compact('horarios','my_horario','sedes'));
  }
}
