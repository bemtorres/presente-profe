@extends('layouts.app')
@push('stylesheet')

<link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endpush
@section('content')
<h1 class="h3 mb-2 text-gray-800">Asignaturas</h1>
@include('asignaturas._tabs')
<div class="row">
  <div class="col-md-7">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Sigla</th>
                <th>Carrera</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($asignaturas as $a)
              <tr>
                <td>{{ $a->id }}</td>
                <td><a href="{{ route('asignaturas.edit', $a->id) }}">{{ $a->nombre }}</a></td>
                <td>{{ $a->sigla }}</td>
                <td>{{ $a->carrera }}</td>
                {{-- <td><a href="{{ route('admin.usuario.show',$u->id) }}">{{ $u->correo }}</a></td> --}}
                {{-- <td>{{ $u->nombre_completo() }}</td> --}}
                {{-- <td>{{ $u->team->nombre ?? '' }}</td> --}}
                {{-- <td> --}}
                  {{-- <img src="{{ asset(current_config()->present()->getImagenCoin()) }}" width="20px" alt=""> --}}
                  {{-- {{ $u->getCredito() }} --}}
                {{-- </td> --}}
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('javascript')
  <script src="{{ asset('vendors/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable();
    });
  </script>
@endpush
