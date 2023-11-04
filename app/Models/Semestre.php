<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
  use HasFactory;
  protected $table = 'semestre';

  public function semanas(){
    return $this->hasMany(Semana::class,'id_semestre');
  }
}
