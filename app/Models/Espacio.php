<?php

namespace App\Models;

use App\Services\Imagen;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Espacio extends Model
{
  use HasFactory;
  protected $table = 'espacio';

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

}
