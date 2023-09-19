<?php

namespace App\Models\dh;

use App\Models\Usuario;
use App\Services\DuocHorario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioPlan extends Model
{
  use HasFactory;

  protected $table = 'dh_horario_plan';

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

  public function usuario(){
    return $this->belongsTo(Usuario::class,'id_usuario');
  }

  public function asociado(){
    return $this->belongsTo(AsociadoPlan::class,'id_asociado_plan');
  }

  public function getDay(){
    return self::DAYS[$this->dia];
  }

  public function getDayText(){
    return self::DAYS_TEXT[$this->dia];
  }

  public function getModulos(){
    return DuocHorario::TIMES[$this->modulo - 1];
  }

  public function getHorario(){
    $m = $this->getModulos();
    return $m[0] . ' - ' . $m[1];
  }

  public function getHorarioEntrada(){
    return $this->getModulos()[0];
  }

  public function getHorarioSalida(){
    return $this->getModulos()[1];
  }

  public function to_raw() {
    return [
      'id' => $this->getDay() . '-' . $this->modulo,
      'dd' => $this->dia,
      'dia' => $this->getDay(),
      'modulo' => $this->modulo,
      'color' => $this->estado == 1 ? 'verde' : 'amarillo',
      'estado' => $this->estado
    ];
  }
}
