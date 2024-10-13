<?php

namespace App\Models;

use App\Services\ConvertDatetime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ClaseEspacio extends Model
{
  use HasFactory;
  protected $table = 'clase_espacio';

  public function espacio() {
    return $this->belongsTo(Espacio::class, 'id_espacio');
  }

  public function asistencias() {
    return $this->hasMany(AsistenciaEspacio::class, 'id_clase_espacio')->orderBy('fecha', 'desc');
  }

  public function getDate() {
    return (new ConvertDatetime($this->fecha));
  }

  public function to_raw() {
    return [
      'id' => $this->id,
      'fecha' => $this->fecha,
      'hora_inicio' => $this->hora_inicio,
      'hora_termino' => $this->hora_termino,
      'codigo_web' => $this->codigo_web,
    ];
  }
}
