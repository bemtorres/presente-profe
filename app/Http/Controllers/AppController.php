<?php

namespace App\Http\Controllers;

use App\Services\DuocHorario;
use Illuminate\Http\Request;

class AppController extends Controller
{

  public function index() {
    // $my_horario = [];
    // if ($mis_horarios->count() != 0) {
    //   $my_horario = $mis_horarios->map(function ($horario) {
    //     return $horario->to_raw();
    //   });
    // }
    $my_horario = [];
    $horarios = DuocHorario::TIMES;

    return view('comparte.index', compact('horarios','my_horario'));
  }
}
