<?php

namespace App\Http\Controllers;

use App\Models\dh\AsignaturaPreferida;
use App\Models\dh\AsociadoPlan;
use App\Models\dh\HorarioPlan;
use App\Models\dh\Plan;
use App\Services\DuocHorario;
use Illuminate\Http\Request;

class ComparteController extends Controller
{

  public function index() {
    $id = 1;
    $id_asociado = 2;
    // create un usuario


    // $plan = Plan::where('id_usuario', current_user()->id)->with('asociado_plan')->findOrFail($id);
    // $asociado = AsociadoPlan::where('id_plan',$plan->id)->with('usuario')->findOrFail($id_asociado);
    // $u = $asociado->usuario;

    // // reporte 1
    // $asignaturas_preferidas = AsignaturaPreferida::where('id_usuario', $u->id)->where('id_plan', $plan->id)->with('asignatura')->orderBy('posicion')->get();

    // // reporte 2
    // $mis_horarios = HorarioPlan::where('id_plan', $plan->id)->where('id_usuario', $u->id)->get();

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
