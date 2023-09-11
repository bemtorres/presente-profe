<?php

namespace App\Models\dh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignaturaPreferida extends Model
{
  use HasFactory;

  protected $table = 'dh_asignatura_preferencia';

  public function plan(){
    return $this->belongsTo(Plan::class,'id_plan');
  }

  public function asignatura(){
    return $this->belongsTo(Asignatura::class,'id_asignatura');
  }

  public function usuario(){
    return $this->belongsTo(Usuario::class,'id_usuario');
  }
}
