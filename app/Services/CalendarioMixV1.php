<?php

namespace App\Services;

use App\Models\Calendario;
use App\Models\RegistroCalendario;

class CalendarioMixV1 {

  protected $periodo;
  protected $semana;
  protected $sala;

  public function __construct(string $periodo,int $semana = 0, int $sala = 0){
    $this->periodo = $periodo;
    $this->semana = $semana;
    $this->sala = $sala;
  }

  public function call() {
    $calendarios = $this->all_calendarios();
    $registros = $this->all_registros();

    $data = $calendarios + $registros;

    return $data;
  }

  public function all_calendarios() {
    $calendarios = Calendario::where('periodo', $this->periodo)
                            ->where('semana', $this->semana)
                            ->where('id_sala', $this->sala)
                            ->get();

    return $this->getRaw($calendarios);
  }

  public function all_registros() {
    $registros = RegistroCalendario::where('periodo', $this->periodo)
                                  ->where('semana', $this->semana)
                                  ->where('id_sala', $this->sala)
                                  ->get();

    return $this->getRaw($registros);
  }

  // PRIVATE FUNCTIONS
  private function getRaw($listado) {
    $data = [];
    foreach ($listado as $key => $item) {
      $data[] = $item->getRaw();
    }
    return $data;
  }
}
