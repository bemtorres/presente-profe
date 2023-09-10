<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;


class Usuario extends Authenticatable
{
  use Notifiable;
  use HasFactory;

  protected $table = 'usuario';
  protected $guard = 'usuario';

  const TIPOS = [
    1 => 'admin',
    2 => 'normal',
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

  function inte_google_id(){
    return $this->integrations['google_id'] ?? null;
  }

  function info_img(){
    return $this->info['img'] ?? null;
  }


  // public function team(){
  //   return $this->belongsTo(Team::class,'id_team');
  // }

  // public function transacciones(){
  //   return $this->hasMany(Transaccion::class,'id_usuario')->with(['accion','producto'])->orderBy('id', 'desc');
  // }

  // public function present(){
  //   return new UsuarioPresenter($this);
  // }

  // public function get_usuario(){
  //   return self::TIPOS[$this->tipo_usuario] ?? '';
  // }


  public function nombre_completo() {
    return $this->nombre . ' ' . $this->apellido_paterno;
  }

  public function getImg() {
    return $this->info_img() ?? asset('app/img/negro.jpg');
  }

  // public function myQR() {
  //   return (new JwtQrEncode($this))->call();
  // }

  // public function getCredito() {
  //   return Currency::getConvert($this->credito) ?? 0;
  // }
}
