@extends('layouts.app')
@push('css')

@endpush
@section('content')
@component('components.button._back')
@slot('route', route('home.index'))
@slot('color', 'secondary')
@slot('body', '<small>Disponibilidad Horaria - <strong>' . $plan->nombre . '</strong></small>')
@endcomponent

@if ($plan->estado == 3)
<div class="row">
  <div class="col-md-12">
    <div class="alert alert-danger" role="alert">
      <p class="mb-0">📣 La edición de <strong>disponibilidad horaria</strong> ha sido desactivada.</p>
    </div>
  </div>
</div>
@endif
@include('dh._tabs')
<div class="card shadow mb-4">
  <div class="row p-3">
    {{-- <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-grid">
                <a name="" id="" class="btn btn-outline-success btn-sm" href="{{ route('disponibilidad.asignaturas',$plan->id) }}">📖 Mis asignaturas</a>
            </li>
            <li class="list-group-item d-grid">
              <a name="" id="" class="btn btn-outline-warning btn-sm text-dark" href="#">📅 Calendario</a>
            </li>
          </ul>
        </div>
      </div>
    </div> --}}

    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <p class="card-text d-flex justify-content-between align-items-center">
            <span>
              📅<strong>Calendario:</strong>
              <small>
                Registra tu calendario de disponibilidad horaria.
                <br>
                <strong>
                  🟩 Disponible
                  🟨 Posible disponibilidad
                </strong>
              </small>
            </span>
            @if ($plan->estado == 2)
            <button type="submit" class="btn btn-primary" id="btn-enviar" onclick="saveCalendario()">
              <span id="spinner-enviar" hidden>
                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                <span role="status"> Guardando...</span>
              </span>
              <span id="text-guardar">Guardar</span>
            </button>
            @endif
          </p>

          <calendario :horarios=@json($horarios) :myhorario=@json($my_horario) :editable="{{ $plan->estado == 2 ? 'true' : 'false' }}"></calendario>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')


<script>

  var myCalendar = [];

  function mainPushData(calendario) {
    myCalendar = calendario;
  }

  function saveCalendario() {
    // enviar un post
    btn = document.getElementById('btn-enviar');
    spinner = document.getElementById('spinner-enviar');
    textSave = document.getElementById('text-guardar');

    btn.disabled = true;
    spinner.hidden = false;
    textSave.hidden = true;

    axios.post("{{ route('disponibilidad.calendario.store', $plan->id) }}", {
      calendario: myCalendar
    }).then(function(response) {
      btn.disabled = false;
      spinner.hidden = true;
      textSave.hidden = false;

      console.log(response);
      if (response.data.status == 200) {
        iziToast.success({
          backgroundColor: '#47c363',
          message: "Calendario guardado"
        });
      }
    }).catch(function(error) {
      console.log(error);
      btn.disabled = false;
      spinner.hidden = true;
      textSave.hidden = false;

      iziToast.error({
        timeout: 0,
        backgroundColor: '#fc544b',
        message: "Error al guardar calendario"
      });
    });
  }
</script>
@endpush
