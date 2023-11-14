<?php

namespace App\Services;
use Carbon\Carbon;
class ConvertDatetime
{
  protected $date;

  const MONTHS = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

  const DAYS = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sábado');

  public function __construct(string $date){
    $this->date = $date;
  }

  public function getDatetime() {
    return $this->format($this->date,'d-m-Y H:i');
  }

  public function getDate() {
    return $this->format($this->date,'d-m-Y');
  }

  public function getDateV2() {
    return $this->format($this->date,'Y-m-d');
  }

  public function getDateV3() {
    return $this->format($this->date,'d/m/Y');
  }


  public function getTime() {
    return $this->format($this->date,'H:i');
  }

  public function getDateTimeZ() {
    return $this->format($this->date,'Y-m-d H:i:s');
  }

  public function getMonth() {
    return self::MONTHS[$this->getDateTimeFormat("m")-1];
  }

  public function getYear() {
    return $this->getDateTimeFormat("Y");
  }

  public function getDay() {
    return $this->getDateTimeFormat("j");
  }

  public function getDayText() {
    return $this->getDateTimeFormat("l");
  }

  public function getDayTextSP() {
    return self::DAYS[$this->getDateTimeFormat("w")];
  }

  public function getTimeClock() {
    return $this->getDateTimeFormat("g:i a");
  }

  public function getDateFormatEmail() {
    // 1 5 March 2021 a las 9:16 pm
    return "{$this->getDay()} {$this->getMonth()} {$this->getYear()} a las {$this->getTimeClock()}";
  }

  public function getDateDateFormatEmail() {
    // 1 5 March 2021 a las 9:16 pm
    return " {$this->getDay()} {$this->getMonth()} {$this->getYear()}";
  }

  public function getDateEuropa() {
    return "{$this->getDay()} de {$this->getMonth()}, {$this->getYear()}";
  }

  public function getDateTimeEuropa() {
    return $this->getDateEuropa() . " - " . $this->getTimeClock();
  }

  // Viernes, 3 de febrero de 2023
  public function getDateVersion() {
    return "{$this->getDayTextSP()}, {$this->getDay()} de {$this->getMonth()}, {$this->getYear()}";
  }

  public function isToday() {
    return date('d-m') == $this->getDateTimeFormat('d-m');
  }

  public function getDatatable() {
    return $this->format($this->date,'Ymd H:i:s');
  }

  public function getDatatimelocal() {
    return $this->format($this->date,'Y-m-d\TH:i') ?? null;
  }

  public function getDateTimeFormat($format){
    return $this->format($this->date,$format);
  }

  public function getStartEnd() {
    $year = $this->format($this->date,'Y');
    $month = $this->format($this->date,'m');
    $date = \Carbon\Carbon::parse($year."-".$month."-01"); // universal truth month's first day is 1
    $start = $date->startOfMonth()->format('Y-m-d'); // 2000-02-01 00:00:00
    $end = $date->endOfMonth()->format('Y-m-d'); // 2000-02-29 23:59:59

    return array('start' => $start,'end' => $end);
  }

  public function getAllDay($n_days) {

    $fechaInicio = Carbon::create($this->date);
    $fechas = [];
    $fechas[] = $this->getDate();

    for ($i = 1; $i <= $n_days; $i++) {
        $fecha = $fechaInicio->addDay();
        $fechas[] = $fecha->format('d-m-Y');
    }

    return $fechas;
  }

  // PRIVATE
  private function format($date, string $format){
    return date_format(date_create($date),$format);
  }

}
