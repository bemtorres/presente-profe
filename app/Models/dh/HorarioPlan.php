<?php

namespace App\Models\dh;

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

  public function usuario(){
    return $this->belongsTo(Usuario::class,'id_usuario');
  }

  public function asociado(){
    return $this->belongsTo(AsociadoPlan::class,'id_asociado_plan');
  }

  public function to_raw() {
    return [
      'id' => self::DAYS[$this->dia] . '-' . $this->modulo,
      'dd' => $this->dia,
      'dia' => self::DAYS[$this->dia],
      'modulo' => $this->modulo,
      'color' => $this->estado == 1 ? 'verde' : 'amarillo',
      'estado' => $this->estado
    ];
  }
}
