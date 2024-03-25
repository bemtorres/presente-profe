<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Services\EmailUser;

class EmailController extends Controller
{
  public function index() {
    $u = Usuario::first();
    $u->correo = 'benja.mora.torres@gmail.com';
    $u->nickname = $u->nickname ?? $u->nombre;
    $email = (new EmailUser($u, 'AAAAAAA'))->registro();

    return $email;
  }
}
