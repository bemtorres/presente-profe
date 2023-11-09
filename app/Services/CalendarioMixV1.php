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

  // public function money(){
  //   return number_format($this->money, $this->decimal, ',', '.');
  // }

  public function call() {
    $calendarios = $this->all_calendarios();

    $registros = RegistroCalendario::where('periodo', $this->periodo)
      ->where('semana', $this->semana)
      ->where('id_sala', $this->sala)
      ->get();


  }

  public function all_calendarios() {
    $calendarios = Calendario::where('periodo', $this->periodo)
      ->where('semana', $this->semana)
      ->where('id_sala', $this->sala)
      ->get();

    $data = [];
    foreach ($calendarios as $keyCa => $ca) {
      $data[] = $ca->getRaw();
    }
    return $data;
  }
}
