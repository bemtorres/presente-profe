
@extends('layouts.app')
@push('css')

<link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<style>
  /* Personalización de la clase media */
.custom-media {
    border: 1px solid #ccc; /* Añadir un borde al componente media */
    padding: 10px; /* Agregar espacio interno al componente media */
    background-color: #f5f5f5; /* Cambiar el color de fondo del componente media */
}

/* Personalización de la imagen dentro de la clase media */
.custom-media img {
    border-radius: 50%; /* Agregar un borde redondeado a la imagen */
}

/* Personalización del contenido dentro de la clase media-body */
.custom-media .media-body {
    font-size: 18px; /* Cambiar el tamaño de fuente del contenido */
    color: #333; /* Cambiar el color del texto del contenido */
}
</style>
@endpush
@section('content')
<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Solicitudes de salas</h1>
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table border table-hover mb-0" id="dataTable">
          <thead class="table-light fw-semibold">
            <tr class="align-middle">
              <th>Fecha solicitud</th>
              <th class="text-center">Usuario</th>
              <th>Sala</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($solicitudes as $s)
            <tr class="align-middle">
              <td>
                {{-- <div class="small text-medium-emphasis">{{ $s->sala->nombre }}</div> --}}
                <div>
                  <small>
                    {{helperDateFormat($s->created_at)->getDateVersion() }}
                  </small>
                </div>
              </td>
              <td>
                <div class="row">
                  <div class="col-2">
                    <div class="avatar avatar-md">
                      <img class="avatar-img" src="{{ $s->usuario->getImg() }}" alt="user@email.com">
                      <span class="avatar-status bg-success"></span>
                    </div>
                  </div>
                  <div class="col">
                    <div>{{ $s->usuario->nombre_completo() }}</div>
                    <div class="small text-medium-emphasis">{{ $s->usuario->correo }}</div>

                  </div>
                </div>
              </td>
              <td>
                <div class="small text-medium-emphasis">{{ $s->sede->nombre }}</div>
                <div class="fw-semibold">{{ $s->sala->nombre }}</div>
              </td>
              <td>
                @switch($s->estado)
                  @case(1)
                    <span class="badge bg-warning">Pendiente</span>
                    @break
                  @case(2)
                    <span class="badge bg-success">Aceptado</span>
                    @break
                  @default
                    <span class="badge bg-danger">Cancelado</span>
                @endswitch
              </td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M8 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3ZM1.5 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Zm13 0a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z"></path></svg>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('solicitud.show', $s->id ) }}">Información</a>
                    {{-- <a class="dropdown-item" href="#">Edit</a> --}}
                    {{-- <a class="dropdown-item text-danger" href="#">Delete</a></div> --}}
                </div>
              </td>
            </tr>

            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
  <script src="{{ asset('vendors/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable();
    });
  </script>
@endpush
