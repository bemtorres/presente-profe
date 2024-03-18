<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalAsignaturaSemana extends Model
{
    use HasFactory;

    protected $table = 'global_asignatura_semana';

    public function asignatura(){
      return $this->belongsTo(GlobalAsignatura::class,'id_asignatura');
    }
}
