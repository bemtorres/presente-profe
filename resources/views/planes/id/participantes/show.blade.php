@extends('layouts.app')
@push('css')

{{-- <link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
<style>
  /* Estilo de los elementos de la lista seleccionada */
.list-group-item-selected {
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
}

/* Estilo para ocultar la lista inicialmente */
#lista {
  display: none;
}

.cursor {
  cursor: pointer;
}
</style>
@endpush
@section('content')
@component('components.button._back')
@slot('route', route('planes.participantes', $plan->id))
@slot('color', 'secondary')
@slot('body', '<small>Participante - <strong>' . $plan->nombre . '</strong></small>')
@endcomponent
@include('planes.id.participantes._tabs')
<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="card mb-4">
              <div class="card-body">
                <ul class="list-group cursor">
                  <li class="list-group-item d-flex justify-content-between align-items-center" id="mostrarLista">
                    <div class="d-flex align-items-center">
                      <div class="avatar avatar-md">
                        <img class="avatar-img" src="{{ $u->getImg() }}" alt="">
                      </div>
                      <div class="ms-2">
                        <span class="h6 mt-2 mt-sm-0">{{ $u->nombre_completo() }}</span>
                        <p class="small m-0">{{ $u->correo }}</p>
                      </div>
                    </div>
                    <div class="text-end">
                      <i class="fa fa-chevron-down"></i>
                    </div>
                  </li>
                </ul>
                <ul class="list-group" id="lista" style="display: none;">
                  @foreach ($plan->asociado_plan as $asociadoo)
                    @continue($asociadoo->id_usuario == $u->id)
                    <li class="list-group-item list-group-item-action d-flex cursor" onclick="window.location = '{{ route('planes.participantes.show',[$plan->id, $asociadoo->id]) }}'">
                      <div class="d-flex align-items-center">
                        <div class="avatar avatar-md">
                          <img class="avatar-img" src="{{ $asociadoo->usuario->getImg() }}" alt="">
                        </div>
                        <div class="ms-2">
                          <span class="h6 mt-2 mt-sm-0">{{ $asociadoo->usuario->nombre_completo() }}</span>
                          <p class="small m-0">{{ $asociadoo->usuario->correo }}</p>
                        </div>
                      </div>
                    </li>
                  @endforeach
                </ul>

                {{-- <a href="{{ route('pdf.diponibilidad', [$plan->id, $asociado->id]) }}" class="btn btn-danger">VER PDF</a> --}}

              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <p class="card-text">
                    📖 <strong>Mis asignaturas</strong>
                    <a href="{{ route('planes.participantes.asignatura', [$plan->id, $asociado->id]) }}" class="ms-2 btn btn-sm btn-primary">Editar</a>
                  </p>
                </div>
                <ul class="list-group list-group-flush">
                  @forelse ($asignaturas_preferidas as $ap)
                    <li class="list-group-item">
                      <span class="badge badge-pill bg-dark">{{  $ap->asignatura->semestre }}</span>
                      {{ $ap->asignatura->toString() }}
                    </li>
                  @empty
                    <li class="list-group-item">
                      No hay asignaturas
                    </li>
                  @endforelse
                </ul>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-body">
                <calendariomain :horarios=@json($horarios) :myhorario=@json($my_horario)></calendariomain>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
  // Manejar el clic en el botón "Mostrar Lista"
  $("#mostrarLista").click(function () {
    $("#lista").slideToggle();
  });

  // Manejar la selección de elementos de la lista
  $("#lista li").click(function () {
    // Desmarcar todos los elementos
    $("#lista li").removeClass("list-group-item-selected");

    // Marcar el elemento seleccionado
    $(this).addClass("list-group-item-selected");
  });


});

</script>

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

    axios.post("{{ route('disponibilidad.calendario.store.main', [$plan->id, $u->id]) }}", {
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
