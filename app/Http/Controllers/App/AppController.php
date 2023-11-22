<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use App\Models\Semestre;
use App\Models\Solicitud;
use App\Services\CalendarioMixV1;
use App\Services\ConvertDatetime;
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

  public function appgo() {
    $u = current_user();

    if ($u->user_app) {
      return redirect()->route('app.sede', $u->id_sede);
    }

    return redirect()->route('app.sede.usuario', $u->id_sede);
  }

  public function indexSede($id_sede) {
    $u = current_user();

    if ($u->tipo_usuario == 2) {
      if (!$u->user_app) {
        return redirect()->route('app.sede.usuario', $u->id_sede);
      }
    }

    $sedes = Sede::where('activo', true)->get();
    $s = Sede::with(['salas'])->findOrFail($id_sede);

    // $s = Sede::with(['salas'])->findOrFail($id_sede);
    $salas = $s->salas;

    $horarios = DuocHorario::TIMES;
    $semestre = Semestre::where('activo', true)->with('semanas')->first();


    $motivos = Solicitud::MOTIVOS;

    // VALIDA Y CHEQUEA LAS SEMANAS
    $semanas = [];
    foreach ($semestre->semanas as $keyS => $valueS) {
      $semanas[] = [
        'id_semana' => $valueS->id,
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

  // USUARIO CONECTADO
  public function indexUserSede($id_sede) {
    $u = current_user();
    if ($u->user_app) {
      return redirect()->route('app.sede', $u->id_sede);
    }

    $sedes = Sede::where('activo', true)->get();

    $s = Sede::with(['salas'])->findOrFail($id_sede);
    $salas = $s->salas;

    $motivos = Solicitud::MOTIVOS;

    // VALIDA Y CHEQUEA LAS SEMANAS
    $horarios = DuocHorario::TIMES;
    $semestre = Semestre::where('activo', true)->with('semanas')->first();
    $semanas = [];
    foreach ($semestre->semanas as $keyS => $valueS) {
      $semanas[] = [
        'id_semana' => $valueS->id,
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

    $usuario = current_user();

    return view('app.usuario.index', compact('s','usuario', 'motivos', 'sedes', 'array_semanas', 'semestre', 'salas', 'horarios'));
  }


  public function index2($id_sede) {
    $my_horario = [];
    $horarios = DuocHorario::TIMES;
    $days = ConvertDatetime::DAYS;
    array_shift($days);
    $days = array_map('strtoupper', $days);

    // return $days;

    $semestre = Semestre::where('activo', true)->with('semanas')->first();
    $semanas = [];
    foreach ($semestre->semanas as $keyS => $valueS) {
      $semanas[] = [
        'id_semana' => $valueS->id,
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

    $s = Sede::with(['salas'])->findOrFail($id_sede);
    $id_sede = 1300;
    $semanas = [17];
    $dias = [1];
    $periodo = '202102';
    $sala = 1;
    $data = (new CalendarioMixV1($periodo, $semanas[0], $sala))->call();

    return view('app.index2',
      compact('horarios',
              'my_horario',
              's',
              'days',
              'array_semanas'
            ));
  }
}
