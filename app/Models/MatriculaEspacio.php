<?php

namespace App\Models;

use App\Services\ConvertDatetime;
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

  public function asistencias() {
    return $this->hasMany(AsistenciaEspacio::class, 'id_matricula_espacio')->orderBy('fecha', 'desc');
  }

  public function reportes() {
    return $this->hasMany(ReporteInasistencia::class, 'id_matricula_espacio')->orderBy('fecha_inicio', 'desc');
  }

}
