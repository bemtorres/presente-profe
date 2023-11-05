<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroCalendario extends Model
{
  use HasFactory;

  protected $table = 'registro_calendario';

  CONST DAYS = [
    1 => 'L',
    2 => 'M',
    3 => 'X',
    4 => 'J',
    5 => 'V',
    6 => 'S'
  ];

  CONST DAYS_TEXT = [
    1 => 'LUNES',
    2 => 'MARTES',
    3 => 'MIERCÓLES',
    4 => 'JUEVES',
    5 => 'VIERNES',
    6 => 'SÁBADO'
  ];

  public function getDay(){
    return self::DAYS[$this->dia];
  }

  public function getDayText(){
    return self::DAYS_TEXT[$this->dia];
  }
}
