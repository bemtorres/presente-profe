@extends('layouts.app.app')
@push('css')
    {{-- <link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
    <style>
        body {
            background: #04243c;
        }

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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<nav class="navbar navbar-expand-md bg-dark bg-cd-primary p-2 mb-3 sticky-top border-bottom border-5 border-warning" data-bs-theme="dark">
  <div class="container justify-content-center">
    <a href="/app" class="d-flex align-items-center link-body-emphasis text-decoration-none">
      <img class="bi me-2" src="{{ asset('template/img/comparte-logo.svg') }}" width="50" height="50">
    </a>
  </div>
</nav>

<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="card mb-4">
              <div class="card-body">
                <buscar-usuario post-buscar='{{ route('api.backend.usuario.buscar') }}'></buscar-usuario>
                <ul class="list-group cursor">
                  <li class="list-group-item d-flex justify-content-between align-items-center" id="mostrarLista">
                    <div class="d-flex align-items-center">
                      <div class="ms-2">
                        <span class="badge rounded-pill text-bg-primary">SEDE SAN JOAQUÍN</span>
                        <p class="h6 mt-2 mt-sm-0">SALA 304</p>
                        <p class="small m-0">PISO 2</p>

                        <p>Capacidad: 30 personas</p>
                        <p>SEMANA 5 - 25-septiembre / 30-septiembre</p>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <p class="card-text">🏦 <strong>SEDE</strong></p>
                        <select name="" id="" class="form-select js-basic-single">
                            @foreach ($sedes as $s)
                                <option value="{{ $s->id }}">{{ $s->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <p class="card-text">📖 <strong>Selecione la sala</strong></p>
                        <select name="" id="" class="form-select js-basic-single">
                            @for ($i = 100; $i <= 400; $i++)
                                @php
                                    $i = $i + 16;
                                @endphp
                                <option value="{{ $i }}">Sala {{ $i }} </option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="semanaSelect">🚪 <strong>Selecciona una semana</strong></label>
                        <select class="form-select" id="semanaSelect">
                          @foreach ($semestre->semanas as $semana)
                            <option value="{{ $semana->semana }}">{{ $semana->getInfo() }}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-body">
                <p class="card-text d-flex justify-content-between align-items-center">
                  <span>📅<strong>Seleccione el horario que desee registrar</strong></span>
                </p>
                <calendariocomparte
                  :horarios=@json($horarios)
                  :myhorario=@json($my_horario)
                  :editable="true"
                  :alertmensaje="alertmensaje"></calendariocomparte>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-basic-single').select2();
        });

        function mainPushData(data) {
            console.log(data);
        }

        function alertmensaje(data) {
            console.log(data);
            // alert(data);
        }

    </script>
@endpush
