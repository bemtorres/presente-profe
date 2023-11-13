<?php

namespace App\Services;


class RegistroDias {

  protected $data;

  public function __construct($registros){
    $this->data = $this->build_params($registros);
  }

  public function call() {
    // $this->ordenar();

    return $this->data;
  }

  public function resumen() {
    return $this->build_resumen();
  }

  private function build_params($array) {
    $data = [];
    foreach ($array as $key => $r) {
      $data[$r->dia] = [
        'dia' => $this->getDay($r->dia),
        'fecha' => null,
        'fecha_text' => null,
        'modulos' => []
      ];
    }

    foreach ($array as $key => $r) {
      if ($data[$r->dia]['fecha'] == null) {
        $data[$r->dia]['fecha'] = $r->fecha;
        $data[$r->dia]['fecha_text'] = $r->getFecha()->getDateVersion();
      }

      $data[$r->dia]['modulos'][] = [
        'id' => $r->id,
        'horario' => $r->getHorario(),
        'modulo' => $r->modulo,
      ];
    }

    // odenar modulos
    $data = $this->ordenarAsc($data);

    return $data;
  }

  private function ordenarAsc($data) {
    foreach ($data as $key => $d) {
      usort($d['modulos'], function($a, $b) {
        return $a['modulo'] - $b['modulo'];
      });

      $data[$key]['modulos'] = $d['modulos'];
    }

    return $data;
  }

  private function ordenarDesc($data) {
    foreach ($data as $key => $d) {
      usort($d['modulos'], function($a, $b) {
        return $b['modulo'] - $a['modulo'];
      });

      $data[$key]['modulos'] = $d['modulos'];
    }

    return $data;
  }

  private function getDay($d) {
    $dia =  [
      1 => 'Lunes',
      2 => 'Martes',
      3 => 'Miercoles',
      4 => 'Jueves',
      5 => 'Viernes',
      6 => 'Sabado',
    ];
    return $dia[$d];
  }

  private function build_resumen() {
    $calendario = [];
    foreach ($this->data as $key => $value) {
      $modulos = [];

      foreach ($value['modulos'] as $keya => $v) {
        $modulos[] = [
          'horario' => $v['horario'],
          'modulo' => $v['modulo'],
        ];
      }

      $calendario[$key] = [
        'fecha' => $value['fecha_text'],
        'modulos' => $modulos,
      ];
    }

    return $calendario;
  }
}
