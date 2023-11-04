<?php

namespace App\Models;

use App\Services\ConvertDatetime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semana extends Model
{
  use HasFactory;
  protected $table = 'semana';

  public function getFechaInicio() {
    return new ConvertDatetime($this->fecha_inicio);
  }

  public function getFechaTermino() {
    return new ConvertDatetime($this->fecha_termino);
  }

  public function getInfo() {
    // SEMANA 1 / 07-08-2023 - 13-08-2023
    return 'SEMANA ' . $this->semana . ' / ' . $this->getFechaInicio()->getDate() . ' - ' . $this->getFechaTermino()->getDate();
  }
}
