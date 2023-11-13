@extends('layouts.app.app')
@push('css')
  <style>
    body {
      background: #04243c;
    }
    .cursor {
      cursor: pointer;
    }
    .table {
      border-radius: 10px;
      overflow: hidden;
    }
    /* .table thead th {
      background-color: #04243c;
      color: #ffffff;
      border-color: #04243c;
    } */
    .table tbody tr:hover {
      background-color: #f0f8ff;
    }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<nav class="navbar navbar-expand-md bg-dark bg-cd-primary p-2 mb-3 sticky-top border-bottom border-5 border-warning" data-bs-theme="dark">
  <div class="container justify-content-center">
    <div data-bs-toggle="modal" data-bs-target="#modalSedes" class="d-flex align-items-center link-body-emphasis text-decoration-none">
      <img class="bi me-2" src="{{ asset('template/img/comparte-logo.svg') }}" width="50" height="50">
    </div>
  </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="modalSedes" tabindex="-1" aria-labelledby="modalSedesLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalSedesLabel">
          🏦 <strong>CAMBIAR SEDE</strong>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <select name="selectedSedes" id="selectedSedes" class="form-select" onchange="seleccionarOpcion()">
            <option value="{{ $s->id }}">--- SELECIONE UNA SEDE ---</option>
            @foreach ($sedes as $sed)
              <option value="{{ $sed->id }}" {{ $s->id == $sed->id ? 'selected' : '' }}>{{ $sed->nombre }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="card">
              <div class="card-body">
                <buscar-usuario
                  post-buscar='{{ route('api.backend.usuario.buscar') }}'
                >
                </buscar-usuario>
                <div class="card text-white bg-dark">
                  <img class="card-img-top" src="{{ $s->getImg() }}" alt="Title">
                  <div class="card-body">
                    <h4 class="card-title">{{ $s->nombre }}</h4>
                    {{-- <p class="card-text">Text</p> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-body">
                <app-sala-view
                :horarios=@json($horarios)
                :salas="{{ json_encode($salas)}}"
                :semestre=@json($semestre)
                :semanasdetall="{{ json_encode($array_semanas) }}"
                :motivos="{{ json_encode($motivos) }}"
                post-buscar-calendario="{{ route('api.backend.calendario.buscar') }}"
                post-store-calendario="{{ route('api.backend.calendario.store') }}"
                post-store-solicitud="{{ route('api.backend.solicitud.store') }}"
                ></app-sala-view>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="questionModal" tabindex="-1" aria-labelledby="questionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Información</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Some borders are removed -->
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <div class="i fa fa-circle text-dark"></div> En clases
          </li>
          <li class="list-group-item">
            <div class="i fa fa-circle text-secondary"></div> Tomado por docente
          </li>
          <li class="list-group-item">
            <div class="i fa fa-circle text-warning"></div> Seleccionado por el usuario
          </li>
        </ul>
      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div> --}}
    </div>
  </div>

@endsection
@push('js')
    <script>
      window._USUARIO = @json(current_user());

      function seleccionarOpcion() {
        var select = document.getElementById("selectedSedes");
        var sedeId = select.value;
        window.location.href = "{{ route('app.index') }}" + "/" + sedeId;
      }
    </script>
@endpush
