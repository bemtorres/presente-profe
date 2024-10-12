<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MatriculaEspacio extends Model
{
  use HasFactory;
  protected $table = 'matricula_espacio';


  public function espacio() {
      return $this->belongsTo(Espacio::class, 'id_espacio');
  }


  public function estudiante() {
    return $this->belongsTo(Usuario::class, 'id_estudiante');
  }
}
