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

  public function to_raw() {
    return [
      'id' => $this->id,
      'id_espacio' => $this->id_espacio,
      'titulo' => $this->titulo,
      'mensaje' => $this->mensaje,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }
}
