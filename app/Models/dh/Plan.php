<?php

namespace App\Models\dh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
  use HasFactory;

  protected $table = 'dh_plan';

  public function detalle_plan(){
    return $this->hasMany(DetallePlan::class,'id_plan')->with(['asignatura'])->orderBy('posicion','asc');
  }

  public function asociado_plan(){
    return $this->hasMany(AsociadoPlan::class,'id_plan')->with(['usuario']);
  }
}
