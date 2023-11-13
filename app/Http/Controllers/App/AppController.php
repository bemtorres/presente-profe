<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use App\Models\Semestre;
use App\Models\Solicitud;
use App\Services\DuocHorario;
use Illuminate\Http\Request;

class AppController extends Controller
{

  public function index() {
    $sedes = Sede::where('activo', true)->get();
    $motivos = Solicitud::MOTIVOS;

    $s = Sede::with(['salas'])->findOrFail(1300);
    $salas = $s->salas;

    $horarios = DuocHorario::TIMES;
    $semestre = Semestre::where('activo', true)->with('semanas')->first();

    $array_semestre = [];

    foreach ($semestre->semanas as $keyS => $valueS) {
      $array_semestre[] = [
        'periodo' => $semestre->periodo,
        'semestre' => $semestre->semestre,
        'info' => $valueS->getInfo(),
        'semana' => $valueS->semana,
        'fecha_inicio' => $valueS->fecha_inicio,
        'fecha_termino' => $valueS->fecha_termino,
      ];
    }

    // return $array_semestre;

    return view('app.index', compact('s', 'semestre','motivos', 'sedes', 'array_semestre', 'semestre', 'salas', 'horarios'));
  }


  public function indexSede($id_sede) {
    $sedes = Sede::where('activo', true)->get();

    $s = Sede::with(['salas'])->findOrFail($id_sede);
    $salas = $s->salas;

    $horarios = DuocHorario::TIMES;
    $semestre = Semestre::where('activo', true)->with('semanas')->first();

    $array_semestre = [];

    $motivos = Solicitud::MOTIVOS;

    foreach ($semestre->semanas as $keyS => $valueS) {
      $array_semestre[] = [
        'periodo' => $semestre->periodo,
        'semestre' => $semestre->semestre,
        'info' => $valueS->getInfo(),
        'semana' => $valueS->semana,
        'fecha_inicio' => $valueS->fecha_inicio,
        'fecha_termino' => $valueS->fecha_termino,
      ];
    }

    return view('app.index', compact('s', 'motivos', 'sedes', 'array_semestre', 'semestre', 'salas', 'horarios'));
  }


  public function index2() {
    $my_horario = [];
    $horarios = DuocHorario::TIMES;

    $sedes = Sede::get();

    return view('app.index2', compact('horarios','my_horario','sedes'));
  }
}
