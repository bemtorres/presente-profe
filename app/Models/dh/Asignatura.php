<?php

namespace App\Models\dh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Asignatura extends Model
{
  use HasFactory;

  protected $table = 'dh_asignatura';


  protected function info(): Attribute {
    return Attribute::make(
        get: fn ($value) => json_decode($value, true),
        set: fn ($value) => json_encode($value),
    );
  }

  function toString() {
    return $this->sigla . ' - ' . $this->nombre;
  }

  function getFile() {
    return $this->info['file'] ?? null;
  }

  function getUrl() {
    return $this->info['url'] ?? null;
  }
}
