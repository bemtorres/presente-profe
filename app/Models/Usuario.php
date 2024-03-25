<?php

namespace App\Models;

use App\Services\Imagen;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Usuario extends Authenticatable
{
  use Notifiable;
  use HasFactory;

  protected $table = 'usuario';
  protected $guard = 'usuario';

  // const TIPOS = [
  //   1 => 'admin',
  //   2 => 'normal',
  // ];

  protected function info(): Attribute {
    return Attribute::make(
        get: fn ($value) => json_decode($value, true),
        set: fn ($value) => json_encode($value),
    );
  }

  protected function integrations(): Attribute {
    return Attribute::make(
        get: fn ($value) => json_decode($value, true),
        set: fn ($value) => json_encode($value),
    );
  }

  public function scopefindByCorreo($query, $correo){
    return $query->where('correo',$correo);
  }


  public function scopefindCodeInvitacion($query, $codigo){
    return $query->where('codigo_invitacion',$codigo);
  }


  // function inte_google_id(){
  //   return $this->integrations['google_id'] ?? null;
  // }

  public function getInfoInvitar() {
    return $this->info['invitar'] ?? false;
  }

  public function getInfoInvitarCount() {
    return $this->info['invitar_count'] ?? 0;
  }

  public function info_img(){
    return $this->info['img'] ?? null;
  }

  public function scopeFindCorreo($query, $correo) {
    return  $query->where('correo', $correo);
  }

  public function nombre_completo() {
    return $this->nombre . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno;
  }

  public function getPhoto(){
    $folder = "assets/usuario";
    $folder_default = "img/";
    $imgDefault = $folder_default.'profile.png';

    $img = $this->imagen;

    if (strpos($this->imagen, "image") !== false) {
      // $folder = $folder_default.$this->imagen;
      $imgDefault = $folder_default.$this->imagen;
      $img = null;
    }
    return (new Imagen($img, $folder, $imgDefault))->call();
  }


  // public function to_raw() {
  //   return [
  //     'id' => $this->id,
  //     'nombre' => $this->nombre,
  //     'run' => $this->run,
  //     'apellido_paterno' => $this->apellido_paterno ,
  //     'apellido_materno' => $this->apellido_materno,
  //     'nombre_completo' => $this->nombre_completo(),
  //     'correo' => $this->correo,
  //     'tipo_usuario' => $this->tipo_usuario == 1 ? 'admin' : 'normal',
  //     'id_sede' => $this->id_sede,
  //     'sede' => $this->sede->nombre,
  //     'img' => $this->getImg(),
  //   ];
  // }
}
