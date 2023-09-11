<?php

namespace App\Services\Policies;

class UsuarioPolicy extends PolicyModel
{
  public function admin($u){
    if ($u->tipo_usuario != 1) {
      return $this->abort();
    }
  }
}
