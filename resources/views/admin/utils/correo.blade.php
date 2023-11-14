
@extends('layouts.app')
@push('css')

<style>
  .form-check-input:checked {
    background-color: var(--cui-form-check-input-checked-bg-color, #f1B634);
    border-color: var(--cui-form-check-input-checked-border-color, #f1B634);
  }

</style>

@endpush
@section('content')
<div class="container-fluid">
  @component('components.button._back')
    @slot('route', route('utils.index'))
    @slot('color', 'secondary')
    @slot('body', 'Correo electrónico')
  @endcomponent
  <div class="card shadow mb-4">
    <div class="card-body row">
      <div class="col-md-4">
        <div class="card text-left">
          <div class="card-body">
            <form action="{{ route('utils.correo') }}" class="form-submit" method="post">
              @csrf
              @method('PUT')
              <input type="hidden" name="opcion" value="1">
              <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" role="switch" id="s_solicitud" name="s_solicitud" {{ $s->isSendEmailSolicitud() ? 'checked' : '' }}>
                <label class="form-check-label" for="s_solicitud">
                  Habilitar correos de solicitud
                </label>
              </div>

              <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" role="switch" id="s_cancelar" name="s_cancelar" {{ $s->isSendEmailCancelar() ? 'checked' : '' }}>
                <label class="form-check-label" for="s_cancelar">
                  Habilitar correos cancelación
                </label>
              </div>

              <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" role="switch" id="s_rechazados" name="s_rechazados" {{ $s->isSendEmailRechazado() ? 'checked' : '' }}>
                <label class="form-check-label" for="s_rechazados">
                  Habilitar correos rechazados
                </label>
              </div>

              <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" role="switch" id="s_aprobado" name="s_aprobado" {{ $s->isSendEmailAceptar() ? 'checked' : '' }}>
                <label class="form-check-label" for="s_aprobado">
                  Habilitar correos aprobados
                </label>
              </div>

              <div class="d-grid">
                <button class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-left">
          <div class="card-body">
            <form action="{{ route('utils.correo') }}" class="form-submit" method="post">
              @csrf
              @method('PUT')
              <input type="hidden" name="opcion" value="2">

              <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" role="switch" id="s_email_test" name="s_email_test" {{$s->isInfoEmail() ? 'checked' : ''}}>
                <label class="form-check-label" for="s_email_test">Habilitar modo test email</label>
              </div>

              <div class="mb-3">
                <label for="" class="form-label">Correo de prueba</label>
                <input type="text"
                  class="form-control" name="email_test" id="email_test" value="{{ $s->getInfoEmailTest() }}">
                {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-lg btn-primary">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
@endpush
