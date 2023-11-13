<?php

namespace App\Services;

use App\Models\Calendario;
use App\Models\RegistroCalendario;
use App\Models\Solicitud;

class CalendarioMixV2 {

  protected $periodo;
  protected $semana;
  protected $sala;
  protected $onlyActivos;
  protected $solicitud;

  public function __construct(string $periodo,int $semana = 0, int $sala = 0, bool $onlyActivos = true, $solicitud){
    $this->periodo = $periodo;
    $this->semana = $semana;
    $this->sala = $sala;
    $this->onlyActivos = $onlyActivos;
    $this->solicitud = $solicitud;
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


    $solicitud = Solicitud::with('registros')->find($this->solicitud);

    // buscamos los que son seleccionados
    foreach ($registros as $keyr => $r) {
      $registros[$keyr]['selected'] = false;
      foreach ($solicitud->registros as $keys => $sr) {
        if ($sr->id == $r->id) {
          $registros[$keyr]['selected'] = true;
          break;
        }
      }
    }

    return $this->getRaw($registros);
  }

  // PRIVATE FUNCTIONS
  private function getRaw($listado) {
    $data = [];
    foreach ($listado as $key => $item) {
      $raw = [];
      $raw = $item->getRaw();
      $raw['selected'] = false;
      $raw['color'] = 'gris';

      if($item['selected'] ?? false) {
        $raw['selected'] = true;
        $raw['color'] = 'info';
      }

      $data[] = $raw;
    }
    return $data;
  }
}
