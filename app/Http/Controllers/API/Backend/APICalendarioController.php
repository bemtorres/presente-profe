<?php

namespace App\Http\Controllers\API\Backend;

use App\Http\Controllers\Controller;
use App\Models\Calendario;
use App\Models\RegistroCalendario;
use App\Models\Sala;
use App\Models\Sede;
use App\Models\Usuario;
use App\Services\CalendarioMixV1;
use App\Services\CalendarioMixV2;
use App\Services\Policies\UsuarioPolicy;
use Illuminate\Http\Request;

class APICalendarioController extends Controller
{
  // private $policy;

  // public function __construct() {
  //   $this->policy = new UsuarioPolicy();
  // }

  public function buscar(Request $request) {
    // $this->policy->admin(current_user());
    $periodo = $request->input('periodo');
    $semana = $request->input('semana');
    $sala = $request->input('sala');

    $data = (new CalendarioMixV1($periodo, $semana, $sala))->call();

    return Response()->json([
      'message' => 'Se ha encontrado correctamente',
      'data' => $data
    ], 200);
  }


  public function buscarAll(Request $request) {
    // $this->policy->admin(current_user());
    $periodo = $request->input('periodo');
    $semana = $request->input('semana');
    $sala = $request->input('sala');
    $solicitud_id = $request->input('solicitud');

    $data = (new CalendarioMixV2($periodo, $semana, $sala, false, $solicitud_id))->call();

    return Response()->json([
      'message' => 'Se ha encontrado correctamente',
      'data' => $data
    ], 200);
  }

  public function store(Request $request) {
    $periodo = $request->input('periodo');
    $semana = $request->input('semana');
    $sala_id = $request->input('sala');

    $sala = Sala::find($sala_id);

    // L, M, X, J, V, S
    $horarios = $request->input('horarios'); // array de registros a guardar [L2] LUNES MODULO 2

    $calendarios = Calendario::where('periodo', $periodo)
                              ->where('semana', $semana)
                              ->where('id_sala', $sala_id)
                              ->get();

    // BUSCAR NUEVOS
    foreach ($horarios as $keyh => $horario) {
      $dia_numero = array_flip(Calendario::DAYS)[$horario['dia']];
      $modulo = $horario['modulo'];

      $horarios[$keyh]['new'] = true;

      foreach ($calendarios as $keyc => $calendario) {
        if ($calendario->dia == $dia_numero && $calendario->modulo == $modulo) {
          $horarios[$keyh]['new'] = false;
        }
      }
    }

    // BUSCAR ELIMINADOS
    foreach ($calendarios as $keyc => $calendario) {
      $calendarios[$keyc]['found'] = false;

      foreach ($horarios as $keyh => $horario) {
        $dia_numero = array_flip(Calendario::DAYS)[$horario['dia']];
        $modulo = $horario['modulo'];
        if ($calendario->dia == $dia_numero && $calendario->modulo == $modulo) {
          $calendarios[$keyc]['found'] = true;
        }
      }
    }


    $reports = [
      'new' => 0,
      'exist' => 0,
      'delete' => 0
    ];

    // ELIMINAR
    foreach ($calendarios as $keyc => $calendario) {
      if ($calendarios[$keyc]['found'] == false) {
        $calendario->delete();
        $reports['delete'] += 1;
      }
    }

    foreach ($horarios as $key => $horario) {
      if ($horarios[$key]['new'] == true) {
        $modulo = $horario['modulo'];
        $dia_numero = array_flip(Calendario::DAYS)[$horario['dia']];

        $c = new Calendario();
        // $c->fecha = '';
        $c->periodo = $periodo;
        $c->semana = $semana;
        $c->dia = $dia_numero;
        $c->modulo = $modulo;
        $c->tipo = 1; // manual
        $c->id_sede = $sala->id_sede;
        $c->id_sala = $sala->id;
        $c->save();

        $reports['new'] += 1;
      } else {
        $reports['exist'] += 1;
      }
    }

    return Response()->json([
      'message' => 'Se ha encontrado correctamente',
      'reports' => $reports
    ], 200);
  }
}
