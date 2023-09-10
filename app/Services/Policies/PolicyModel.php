<?php

namespace App\Services\Policies;

class PolicyModel
{

  public function abort(){
    return abort('403');
  }

}
