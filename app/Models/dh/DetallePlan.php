<?php

namespace App\Models\dh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePlan extends Model
{
  use HasFactory;

  protected $table = 'dh_detalle_plan';

  public function asignatura(){
    return $this->belongsTo(Asignatura::class,'id_asignatura');
  }
}
