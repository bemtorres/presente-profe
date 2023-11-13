<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use App\Models\Semestre;
use App\Models\Solicitud;
use App\Services\DuocHorario;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppController extends Controller
{

  public function index() {
    return redirect()->route('app.sede', 1300);
  //   $sedes = Sede::where('activo', true)->get();
  //   $motivos = Solicitud::MOTIVOS;

  //   $s = Sede::with(['salas'])->findOrFail(1300);
  //   $salas = $s->salas;

  //   $horarios = DuocHorario::TIMES;
  //   $semestre = Semestre::where('activo', true)->with('semanas')->first();

  //   $array_semestre = [];

  //   foreach ($semestre->semanas as $keyS => $valueS) {
  //     $array_semestre[] = [
  //       'periodo' => $semestre->periodo,
  //       'semestre' => $semestre->semestre,
  //       'info' => $valueS->getInfo(),
  //       'semana' => $valueS->semana,
  //       'fecha_inicio' => $valueS->fecha_inicio,
  //       'fecha_termino' => $valueS->fecha_termino,
  //     ];
  //   }

  //   // return $array_semestre;

  //   return view('app.index', compact('s', 'semestre','motivos', 'sedes', 'array_semestre', 'semestre', 'salas', 'horarios'));
  }


  public function indexSede($id_sede) {
    $sedes = Sede::where('activo', true)->get();

    $s = Sede::with(['salas'])->findOrFail($id_sede);
    $salas = $s->salas;

    $horarios = DuocHorario::TIMES;
    $semestre = Semestre::where('activo', true)->with('semanas')->first();


    $motivos = Solicitud::MOTIVOS;

    // VALIDA Y CHEQUEA LAS SEMANAS
    $semanas = [];
    foreach ($semestre->semanas as $keyS => $valueS) {
      $semanas[] = [
        'periodo' => $semestre->periodo,
        'semestre' => $semestre->semestre,
        'info' => $valueS->getInfo(),
        'semana' => $valueS->semana,
        'fecha_inicio' => $valueS->fecha_inicio,
        'fecha_termino' => $valueS->fecha_termino,
        'today' => $valueS->isToday()
      ];
    }

    $array_semanas = [];
    $is_check = false;
    foreach ($semanas as $key => $semana) {
      if ($semana['today']) { $is_check = true; }
      if ($is_check) { $array_semanas[] = $semana; }
    }

    return view('app.index', compact('s', 'motivos', 'sedes', 'array_semanas', 'semestre', 'salas', 'horarios'));
  }


  public function index2() {
    $my_horario = [];
    $horarios = DuocHorario::TIMES;

    $sedes = Sede::get();

    return view('app.index2', compact('horarios','my_horario','sedes'));
  }
}
