<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
  use HasFactory;
  protected $table = 'solicitud';

  const ESTADO = [
    1 => 'Pendiente',
    2 => 'Aprobado',
    3 => 'Rechazado',
    4 => 'Cancelado',
  ];

  const MOTIVOS = [
    10 => 'Recuperación de clases',
    20 => 'Revisión de pruebas',
    30 => 'Reuniones',
    40 => 'Capacitaciones',
    50 => 'Educación continua',
    100 => 'Otros'
  ];

  public function usuario(){
    return $this->belongsTo(Usuario::class,'id_usuario');
  }

  public function revisor(){
    return $this->belongsTo(Usuario::class,'id_revisor');
  }

  public function sala(){
    return $this->belongsTo(Sala::class,'id_sala');
  }

  public function sede(){
    return $this->belongsTo(Sede::class,'id_sede');
  }

  public function sem(){
    return $this->belongsTo(Semana::class,'semana','id');
  }

  public function registros(){
    return $this->hasMany(RegistroCalendario::class,'id_solicitud');
  }

  public function getEstado(){
    return self::ESTADO[$this->estado];
  }

  public function getMotivo(){
    return self::MOTIVOS[$this->motivo];
  }
}
