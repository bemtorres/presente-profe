<?php

namespace App\Services\Policies;

class UsuarioPolicy extends PolicyModel
{
  public function admin($u){
    if (!$u->admin) {
      return $this->abort();
    }
  }
}
