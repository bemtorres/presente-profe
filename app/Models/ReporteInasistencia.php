<?php

namespace App\Models;

use App\Services\ConvertDatetime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ReporteInasistencia extends Model
{
  use HasFactory;
  protected $table = 'reporte_inasistencia';


  public function getDate() {
    return (new ConvertDatetime($this->fecha_inicio));
  }

  public function matricula() {
    return $this->belongsTo(MatriculaEspacio::class, 'id_matricula_espacio');
  }

  public function to_raw(){
    return [
      'id' => $this->id,
      // 'id_matricula_espacio' => $this->id_matricula_espacio,
      'fecha_inicio' => $this->fecha_inicio,
      'mensaje' => $this->mensaje,
      // 'estado' => $this->estado,
      // 'created_at' => $this->created_at,
      // 'updated_at' => $this->updated_ast,
    ];
  }
}
