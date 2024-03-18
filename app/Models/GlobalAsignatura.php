<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalAsignatura extends Model
{
  use HasFactory;

  protected $table = 'global_asignatura';

  protected $fillable = [
    'siglas',
    'nombre',
    'descripcion',
    'assets'
  ];

  protected function assets(): Attribute {
    return Attribute::make(
        get: fn ($value) => json_decode($value, true),
        set: fn ($value) => json_encode($value),
    );
  }

  // public function semanas(){
  //   return $this->hasMany(GlobalAsignaturaSemana::class,'id_asignatura')->orderBy('semana');
  // }
}
