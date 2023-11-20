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
  <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.6/dist/vue-multiselect.min.css">
@endpush
@section('content')
<nav class="navbar navbar-expand-md bg-dark bg-cd-primary p-2 mb-3 sticky-top border-bottom border-5 border-warning" data-bs-theme="dark">
  <div class="container justify-content-center">
    <div class="d-flex align-items-center link-body-emphasis text-decoration-none">
      {{-- <div data-bs-toggle="modal" data-bs-target="#modalSedes" class="d-flex align-items-center link-body-emphasis text-decoration-none"> --}}
      <img class="bi me-2" src="{{ asset('template/img/comparte-logo.svg') }}" width="50" height="50">
    </div>
  </div>
</nav>

<!-- Modal -->
{{-- <div class="modal fade" id="modalSedes" tabindex="-1" aria-labelledby="modalSedesLabel" aria-hidden="true">
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
</div> --}}

<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                  <strong>Comparte duoc!</strong> <br>
                  <small>¡Solicita una sala de manera rápida y sencilla!</small>
                </div>
                <div class="card shadow mb-3">
                  <div class="row">
                    <div class="col-md-4 mb-3 text-center">
                      <img src="{{ $usuario->getImg() }}" class="img-fluid rounded-start p-4" alt="...">
                      <span class="badge bg-dark rounded-pill ms-2">{{ $usuario->sede->nombre }}</span>
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <p class="card-title">{{  $usuario->nombre_completo()  }}</p>
                        <small>{{ $usuario->run  }}</small>
                        <small class="card-text">{{ $usuario->correo }}</small>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card text-white bg-dark">
                  <img class="card-img-top" src="{{ $s->getImg() }}" alt="Title">
                  <div class="card-body">
                    <h4 class="card-title">{{ $s->nombre }}</h4>
                    {{-- <p class="card-text">Text</p> --}}
                    <div class="d-grid gap-3">
                      <a href="{{ route('solicitud.me') }}" class="btn btn-warning">
                        MIS SOLICITUDES
                      </a>

                      <a href="{{ route('logout') }}" class="btn btn-danger">
                        Cerrar Sesión
                      </a>
                    </div>
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
      window._USUARIO = @json($usuario->to_raw());

      // function seleccionarOpcion() {
        // var select = document.getElementById("selectedSedes");
        // var sedeId = select.value;
        // window.location.href = "{{ route('app.index') }}" + "/" + sedeId;
      // }
    </script>
@endpush
