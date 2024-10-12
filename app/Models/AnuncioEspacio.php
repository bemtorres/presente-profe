<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AnuncioEspacio extends Model
{
  use HasFactory;
  protected $table = 'espacio_anuncio';


  public function espacio() {
    return $this->belongsTo(Espacio::class, 'id_espacio');
  }
}
