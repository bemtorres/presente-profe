<div class="my-3 text-center">
  <div class="small text-medium-emphasis">
    @switch($s->estado)
      @case(1)
        <div class="alert alert-warning" role="alert"><strong>Pendiente de aprobación</strong></div>
        @break
      @case(2)
        <div class="alert alert-success" role="alert"><strong>Aceptado</strong></div>
        @break
      @case(3)
        <div class="alert alert-danger" role="alert"><strong>Rechazado</strong></div>
        @break
      @default
        <div class="alert alert-dark" role="alert"><strong>Cancelado por el usuario</strong></div>
    @endswitch
  </div>
</div>
