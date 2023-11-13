<?php

namespace App\Services;

use App\Models\Calendario;
use App\Models\RegistroCalendario;

class CalendarioMixV1 {

  protected $periodo;
  protected $semana;
  protected $sala;
  protected $onlyActivos;

  public function __construct(string $periodo,int $semana = 0, int $sala = 0, bool $onlyActivos = true){
    $this->periodo = $periodo;
    $this->semana = $semana;
    $this->sala = $sala;
    $this->onlyActivos = $onlyActivos;
  }

  public function call() {
    $calendarios = $this->all_calendarios();
    $registros = $this->all_registros();

    $data = array_merge($calendarios,$registros);


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
    // ESTADO = [
    //   1 => 'Pendiente',
    //   2 => 'Aprobado',
    //   3 => 'Rechazado',
    //   4 => 'Cancelado',
    // ];
    $query = RegistroCalendario::where('periodo', $this->periodo)
                                  ->where('semana', $this->semana)
                                  ->where('id_sala', $this->sala);

    if ($this->onlyActivos) {
      $query = $query->whereIn('estado',[1,2]);
    }

    $registros = $query->with(['usuario','usuario.sede'])->get();

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
