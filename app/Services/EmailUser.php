<?php

namespace App\Services;

use App\Mail\ResetPasswordEmail;
use App\Models\Usuario;
use Illuminate\Support\Facades\Mail;

class EmailUser
{
  private $usuario;
  private $new_pass;

  public function __construct(Usuario $u, $new_pass){
    $this->usuario = $u;
    $this->new_pass = $new_pass;
  }

  public function password_reset() {
    $info = [
      'nombre' => $this->usuario->nombre_completo() ?? '',
      'password' => $this->new_pass,
      'email' => $this->usuario->correo ?? '',
    ];

    $mail = new ResetPasswordEmail('🔑 Solicitud de recuperación de contraseña', $info);
    $m = Mail::to($this->usuario->correo)->queue($mail);

    return true;
  }

  public function registro() {
    $info = [
          'nombre' => $this->usuario->nombre_completo() ?? '',
          'password' => $this->new_pass,
          'email' => $this->usuario->correo ?? '',
        ];
    $mail = new ResetPasswordEmail('👽 BIENVENIDOS A PRESENTEPROFE.CL 👽', $info);
    $m = Mail::to($this->usuario->correo)->queue($mail);
    return true;
  }
}
