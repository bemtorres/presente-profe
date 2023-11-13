<?php

namespace App\Models;

use App\Services\ConvertDatetime;
use App\Services\DuocHorario;
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

  public function solicitud(){
    return $this->belongsTo(Solicitud::class, 'id_solicitud');
  }

  public function sede(){
    return $this->belongsTo(Sede::class, 'id_sede');
  }

  public function sala(){
    return $this->belongsTo(Sala::class, 'id_sala');
  }

  public function usuario(){
    return $this->belongsTo(Usuario::class, 'id_usuario');
  }

  public function getFecha() {
    return new ConvertDatetime($this->fecha);
  }

  public function getModulo() {
    return DuocHorario::TIMES[$this->modulo - 1] ?? 'SIN MODULO';
  }

  public function getHorario() {
    $modulo = $this->getModulo();
    if ($modulo == 'SIN MODULO') {
      return '';
    }
    return $modulo[0] . ' - ' . $modulo[1];
  }


  public function getRaw(){
    return [
      'id' => self::DAYS[$this->dia] . '-' . $this->modulo,
      'dia' => self::DAYS[$this->dia],
      'modulo' => $this->modulo,
      'color' => 'info',
      'usuario' => $this->usuario->to_raw(),
    ];
  }

  public function getRawMin(){
    return [
      'id' => self::DAYS[$this->dia] . '-' . $this->modulo,
      'dia' => self::DAYS[$this->dia],
      'modulo' => $this->modulo,
      'color' => 'info',
    ];
  }
}
