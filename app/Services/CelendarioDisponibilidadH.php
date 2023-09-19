<?php

namespace App\Services;

use App\Models\dh\AsociadoPlan;
use App\Models\dh\HorarioPlan;

class CelendarioDisponibilidadH {

  private $plan_id;
  private $asociado_id;

  public function __construct($plan_id,$asociado_id){
    $this->plan_id = $plan_id;
    $this->asociado_id = $asociado_id;
  }


  public function call() {
    $asociado = AsociadoPlan::where('id_plan',$this->plan_id)->with('usuario')->findOrFail($this->asociado_id);
    $u = $asociado->usuario;

    // return $asignaturas_preferidas;
    // reporte 2
    $mis_horarios = HorarioPlan::where('id_plan', $this->plan_id)->where('id_usuario', $u->id)->get();

    $horarios = DuocHorario::TIMES;

    $calendario = [];
    foreach ($horarios as $m => $horario) {
      $modulo = $m + 1;
      $calendario[$modulo]['modulo'] = $modulo;
      $calendario[$modulo]['jornada'] = $horario;
      for ($dia=1; $dia < 7; $dia++) {
        $calendario[$modulo]['dias'][$dia] = [
          'selected' => false,
          'color' => null
        ];
      }
    }

    foreach ($mis_horarios as $horario) {
      $modulo = $horario->modulo;
      $dia = $horario->dia;
      $calendario[$modulo]['dias'][$dia]['selected'] = true;
      $calendario[$modulo]['dias'][$dia]['color'] = $horario->estado;
    }

    return $calendario;
  }
}
