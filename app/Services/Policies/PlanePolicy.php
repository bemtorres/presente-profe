<?php

namespace App\Services\Policies;

class PlanePolicy extends PolicyModel
{
  public function index($u){
    if (!$this->admin($u)) {
      return $this->abort();
    }
  }

  public function edit($u){
    return $this->index($u);
  }

  public function store($u){
    return $this->index($u);
  }

  public function show($u){
    return $this->index($u);
  }

  public function update($u){
    return $this->index($u);
  }

  public function participantes($u){
    return $this->index($u);
  }

  //PRIVATE

  private function admin($u) {
    return $u->tipo_usuario == 1;
  }
}
