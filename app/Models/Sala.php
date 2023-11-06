<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
  use HasFactory;
  protected $table = 'sala';

  public function sede(){
    return $this->belongsTo(Sede::class,'id_sede');
  }
}
