<?php

namespace App\Models;

use App\Services\ConvertDatetime;
use Carbon\Carbon;
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

  public function getWeeks() {
    return (new ConvertDatetime($this->fecha_inicio))->getAllDay(7);
  }

  public function isToday(){
    $hoy = Carbon::now();
    $fi = Carbon::parse($this->fecha_inicio);
    $ft = Carbon::parse($this->fecha_termino);

    if ($hoy->between($fi, $ft)) {
        return true;
    }
    return false;
  }
}
