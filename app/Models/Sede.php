<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Sede extends Model
{
  use HasFactory;
  protected $table = 'sede';

  protected function integrations(): Attribute {
    return Attribute::make(
        get: fn ($value) => json_decode($value, true),
        set: fn ($value) => json_encode($value),
    );
  }

  protected function info(): Attribute {
    return Attribute::make(
        get: fn ($value) => json_decode($value, true),
        set: fn ($value) => json_encode($value),
    );
  }

  public function scopeFindActivo($query) {
    return $query->where('estado', true);
  }

  public function salas(){
    return $this->hasMany(Sala::class,'id_sede')->orderBy('nombre');
  }

  public function getImg() {
    return asset('template/img'. $this->img);
  }

  public function getInfoCorreo() {
    return $this->info['correos_copia'] ?? [];
  }

  public function getInfoCorreoActivo() {
    return collect($this->info['correos_copia'] ?? [])->filter(function($item) {
      return $item['status'] ?? false;
    });
  }
}
