<?php

namespace App\Models;

use App\Services\Imagen;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
  use Notifiable;
  use HasFactory;
  use HasApiTokens;

  protected $table = 'usuario';
  protected $guard = 'usuario';

  const PERFIL = [
    1 => 'admin',
    2 => 'docente',
    3 => 'estudiante',
  ];

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
    return $this->nombre . ' ' . $this->apellido;
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

  public function getPefil() {
    return self::PERFIL[$this->perfil];
  }

  public function to_raw() {
    return [
      'id' => $this->id,
      'run' => $this->run,
      'nombre' => $this->nombre,
      'apellido' => $this->apellido ,
      'nombre_completo' => $this->nombre_completo(),
      'correo' => $this->correo,
      'perfil' => $this->getPefil(),
      // 'tipo_usuario' => $this->tipo_usuario == 1 ? 'admin' : 'normal',
      'img' => asset($this->getPhoto())
    ];
  }
}
