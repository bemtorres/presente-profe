<?php

namespace App\Models\dh;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsociadoPlan extends Model
{
  use HasFactory;

  protected $table = 'dh_asociado_plan';

  public function usuario(){
    return $this->belongsTo(Usuario::class,'id_usuario');
  }

  public function plan(){
    return $this->belongsTo(Plan::class,'id_plan');
  }
}
