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


  public function getDate() {
    return (new ConvertDatetime($this->fecha));
  }
}
