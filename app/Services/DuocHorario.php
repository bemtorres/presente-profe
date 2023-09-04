<?php

namespace App\Services;

use DateTime;

class DuocHorario
{
  CONST TIMES = [
    ['8:31','9:10'],
    ['9:11','9:50'],
    ['10:01','10:40'],
    ['10:41','11:20'],
    ['11:31','12:10'],
    ['12:11','12:50'],
    ['13:01','13:40'],
    ['13:41','14:20'],
    ['14:31','15:10'],
    ['15:11','15:50'],
    ['16:01','16:40'],
    ['16:41','17:20'],
    ['17:31','18:10'],
    ['18:11','18:50'],
    ['19:01','19:40'],
    ['19:41','20:20'],
    ['20:31','21:10'],
    ['21:11','21:50'],
    ['21:51','22:30'],
  ];

  public function __construct(){
  }

  public function call() {
    $calendars = [];
    foreach (self::TIMES as $k => $v) {
      $calendar = [];
      $calendar['horario'] = [ 'inicio' => $v[0], 'termino' => $v[1]];
      $calendar['min'] = $this->getMin($v[0],$v[1]);
      for ($i=0; $i < 6; $i++) {
        $calendar[] = [];
      }
      array_push($calendars, $calendar);
    }

    return $calendars;
  }

  public function getMin($inicio, $termino) {
    $fechaUno=new DateTime($inicio);
    $fechaDos=new DateTime($termino);

    $diff = abs($fechaUno->getTimestamp() - $fechaDos->getTimestamp());
    return $diff/60;
  }
}
