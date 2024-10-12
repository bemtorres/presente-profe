<?php

namespace App\Models;

use App\Services\ConvertDatetime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AsistenciaEspacio extends Model
{
  use HasFactory;
  protected $table = 'asistencia_espacio';


  public function clase() {
    return $this->belongsTo(ClaseEspacio::class, 'id_clase_espacio');
  }

  public function matricula() {
    return $this->belongsTo(MatriculaEspacio::class, 'id_matricula_espacio');
  }

  public function getDate() {
    return (new ConvertDatetime($this->fecha));
  }
}
