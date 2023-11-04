
@extends('layouts.app')
@push('css')

<link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endpush
@section('content')
<div class="container-fluid">
  @component('components.button._back')
    @slot('route', route('utils.index'))
    @slot('color', 'secondary')
    @slot('body', 'Configuración de salas')
  @endcomponent

  @include('admin.sede._tabs')
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Salas habilitadas</th>
              <th>Salas inactivas</th>
              <th>Estado</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($sedes as $s)
            <tr>
              <td>{{ $s->nombre }}</td>
              <td>{{ $s->salas->count() }}</td>
              <td>0</td>
              {{-- <td>
                @if ($s->comparte)
                  <i class="fa fa-circle-check text-success"></i>
                @else
                  <i class="fa fa-times text-danger"></i>
                @endif
              </td> --}}
              <td>
                @if ($s->activo)
                  <i class="fa fa-circle-check text-success"></i>
                @else
                  <i class="fa fa-times text-danger"></i>
                @endif
              </td>
              <td>
                <a href="{{ route('sedes.show', $s->id) }}" class="btn btn-primary btn-sm">Gestionar</a>
              </td>
              {{-- <td>{{ $u->id }}</td>
              <td><a href="{{ route('usuarios.show',$u->id) }}">{{ $u->correo }}</a></td>
              <td>{{ $u->nombre_completo() }}</td>
              <td>
                @if ($u->tipo_usuario == 1)
                  <i class="fa-solid fa-user-shield"></i>
                @elseif ($u->tipo_usuario == 2)
                  <i class="fa-solid fa-user text-primary"></i>
                @endif
                @if ($u->inte_google_id())
                  <span class="ms-2"><i class="fa-brands fa-google text-danger"></i></span>
                @endif
              </td> --}}
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
