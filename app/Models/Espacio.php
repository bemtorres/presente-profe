<?php

namespace App\Models;

use App\Services\Imagen;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Espacio extends Model
{
  use HasFactory;
  protected $table = 'espacio';

  public function usuario() {
    return $this->belongsTo(Usuario::class, 'id_usuario');
  }

  public function anuncios() {
    return $this->hasMany(AnuncioEspacio::class, 'id_espacio')->orderBy('created_at', 'desc');
  }

  public function matriculas() {
      return $this->hasMany(MatriculaEspacio::class, 'id_espacio');
  }

  public function clases() {
    return $this->hasMany(ClaseEspacio::class, 'id_espacio')->orderBy('fecha', 'desc');
  }


  public function getPhoto(){
    $folder = "assets/espacios";
    $folder_default = "img/template";

    $fotos = [
      '/template_espacio1.png',
      '/template_espacio2.png',
      '/template_espacio3.png',
      '/template_espacio4.png',
    ];

    $imgDefault = $folder_default . $fotos[array_rand($fotos,1)];

    $img = $this->imagen;

    if (strpos($this->imagen, "image") !== false) {
      // $folder = $folder_default.$this->imagen;
      $imgDefault = $folder_default.$this->imagen;
      $img = null;
    }
    return (new Imagen($img, $folder, $imgDefault))->call();
  }


  public function to_raw() {
    return [
      'id' => $this->id,
      'nombre' => $this->nombre,
      'descripcion' => $this->descripcion,
      'imagen' => asset($this->getPhoto()),
      'id_usuario' => $this->id_usuario,
      'usuario' => $this->usuario->to_raw(),
      // 'created_at' => $this->created_at,
      // 'updated_at' => $this->updated_at,
    ];
  }



}
