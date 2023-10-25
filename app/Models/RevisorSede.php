<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisorSede extends Model
{
  use HasFactory;
  protected $table = 'revisor_sede';

  public function sede(){
    return $this->belongsTo(Sede::class,'id_sede');
  }

  public function usuario(){
    return $this->belongsTo(Usuario::class,'id_usuario');
  }
}
