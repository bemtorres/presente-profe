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
}
