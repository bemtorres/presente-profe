<?php

namespace App\Models\dh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
  use HasFactory;

  const ESTADOS = [
    1 => 'Edición',
    2 => 'En proceso',
    3 => 'Finalizado',
    10 => 'Borrado',
  ];

  protected $table = 'dh_plan';

  public function detalle_plan(){
    return $this->hasMany(DetallePlan::class,'id_plan')->with(['asignatura'])->orderBy('posicion','asc');
  }

  public function asociado_plan(){
    return $this->hasMany(AsociadoPlan::class,'id_plan')->with(['usuario']);
  }

  public function users_asignaturas(){
    return $this->hasMany(AsignaturaPreferida::class,'id_plan')->with(['usuario']);
  }
}
