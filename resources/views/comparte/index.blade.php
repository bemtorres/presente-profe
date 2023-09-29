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
@slot('body', '<small>Reserva de sala - <strong>SALA 304</strong></small>')
@endcomponent
{{-- @include('planes.id.participantes._tabs') --}}
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
                      {{-- <div class="avatar avatar-md">
                        <i class="fa-solid fa-square fa-2x text-success"></i>
                        <img class="avatar-img" src="{{ $u->getImg() }}" alt="">
                      </div> --}}
                      <div class="ms-2">
                        <p class="badge rounded-pill text-bg-primary">SEDE SAN JOAQUÍN</p>

                        <p class="h6 mt-2 mt-sm-0">SALA 304</p>
                        <p class="small m-0">PISO 2</p>

                        <p>Capacidad: 30 personas</p>
                        <p>SEMANA 5 - 25-septiembre / 30-septiembre</p>
                      </div>
                    </div>
                    {{-- <div class="text-end">
                      <i class="fa fa-chevron-down"></i>
                    </div> --}}
                  </li>
                </ul>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="mb-3">
                  <p class="card-text">🏦 <strong>SEDE</strong></p>
                  <select name="" id="" class="form-select">
                      <option value="sanjoaquin">SAN JOAQUÍN</option>
                      <option value="sanjoaquin">SAN BERNARDO</option>
                      <option value="sanjoaquin">MAIPÚ</option>
                  </select>
                </div>
                <p class="card-text">📖 <strong>Selecione la sala</strong></p>
                <select name="" id="" class="form-select">
                  @for ($i = 100; $i <= 400; $i++)
                    @php
                        $i = $i + 16;
                    @endphp
                    <option value="{{ $i }}">Sala {{ $i }} </option>
                  @endfor
                </select>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-body">
                <p class="card-text d-flex justify-content-between align-items-center">
                  <span>
                    📅<strong>Calendario:</strong>
                    <small>
                      Seleciona el horario que deseas reservar
                      <br>
                      <strong>
                        🟩 CLASES
                        🟨 Registrada por un docente
                      </strong>
                    </small>
                  </span>
                </p>
                <div class="mb-3">

                  <div class="container">
                    <label for="semana">Selecciona una semana:</label>
                    <select class="form-select" id="semana">
                      <option value="0">TODAS</option>
                      <option value="1" selected>SEMANA 1 / 07-08-2023 - 13-08-2023</option>
                      <option value="2">SEMANA 2 / 14-08-2023 - 20-08-2023</option>
                      <option value="3">SEMANA 3 / 21-08-2023 - 27-08-2023</option>
                      <option value="4">SEMANA 4 / 28-08-2023 - 03-09-2023</option>
                      <option value="5">SEMANA 5 / 04-09-2023 - 10-09-2023</option>
                      <option value="6">SEMANA 6 / 11-09-2023 - 17-09-2023</option>
                      <option value="7">SEMANA 7 / 18-09-2023 - 24-09-2023</option>
                      <option value="8">SEMANA 8 / 25-09-2023 - 01-10-2023</option>
                      <option value="9">SEMANA 9 / 02-10-2023 - 08-10-2023</option>
                      <option value="10">SEMANA 10 / 09-10-2023 - 15-10-2023</option>
                      <option value="11">SEMANA 11 / 16-10-2023 - 22-10-2023</option>
                      <option value="12">SEMANA 12 / 23-10-2023 - 29-10-2023</option>
                      <option value="13">SEMANA 13 / 30-10-2023 - 05-11-2023</option>
                      <option value="14">SEMANA 14 / 06-11-2023 - 12-11-2023</option>
                      <option value="15">SEMANA 15 / 13-11-2023 - 19-11-2023</option>
                      <option value="16">SEMANA 16 / 20-11-2023 - 26-11-2023</option>
                      <option value="17">SEMANA 17 / 27-11-2023 - 03-12-2023</option>
                      <option value="18">SEMANA 18 / 04-12-2023 - 10-12-2023</option>
                    </select>
                  </div>
                </div>
                <calendariocomparte :horarios=@json($horarios) :myhorario=@json($my_horario) :editable="true"></calendariocomparte>
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

@endpush
