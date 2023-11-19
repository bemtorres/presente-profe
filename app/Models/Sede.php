<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
  use HasFactory;
  protected $table = 'sede';

  public function scopeFindActivo($query) {
    return $query->where('estado', true);
  }

  public function salas(){
    return $this->hasMany(Sala::class,'id_sede')->orderBy('nombre');
  }

  public function getImg() {
    return asset('template/img'. $this->img);
  }
}
