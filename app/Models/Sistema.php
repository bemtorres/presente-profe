<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Sistema extends Model
{
  use HasFactory;
  protected $table = 'sistema';

  protected function info(): Attribute {
    return Attribute::make(
        get: fn ($value) => json_decode($value, true),
        set: fn ($value) => json_encode($value),
    );
  }

  protected function config(): Attribute {
    return Attribute::make(
        get: fn ($value) => json_decode($value, true),
        set: fn ($value) => json_encode($value),
    );
  }

  public function isSendEmailSolicitud() {
    return $this->info['send_email_solicitud'] ?? false;
  }

  public function isSendEmailCancelar() {
    return $this->info['send_email_cancelar'] ?? false;
  }

  public function isSendEmailAceptar() {
    return $this->info['send_email_aceptar'] ?? false;
  }

  public function isSendEmailRechazado() {
    return $this->info['send_email_rechazado'] ?? false;
  }

  public function isInfoEmail() {
    return $this->info['is_email_test'] ?? false;
  }

  public function getInfoEmailTest() {
    return $this->info['email_test'] ?? null;
  }
}
