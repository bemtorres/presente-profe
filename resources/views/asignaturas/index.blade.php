@extends('layouts.app')
@push('css')

<link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endpush
@section('content')
<h1 class="h3 mb-2 text-gray-800">Asignaturas</h1>
@include('asignaturas._tabs')
<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                {{-- <th>id</th> --}}
                <th>Programa</th>
                <th>Semestre</th>
                <th>Cod. Asig</th>
                <th>Descripcion</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($asignaturas as $a)
              <tr>
                {{-- <td>{{ $a->id }}</td> --}}
                <td>{{ $a->programa }}</td>
                <td>{{ $a->semestre }}</td>
                <td>{{ $a->sigla }}</td>
                <td>{{ $a->nombre }}</td>
                <td>
                  @if ($a->getFile())
                    <a href="{{ route('asignaturas.pdf', $a->id) }}" class="btn btn-sm btn-danger me-2"><strong>PDF</strong></a>
                  @endif
                  @if ($a->getUrl())
                    <a href="{{ $a->getUrl() }}" target="_blank" class="btn btn-sm btn-dark me-2"><strong>LINK</strong></a>
                  @endif
                </td>
                <td>
                  <a href="{{ route('asignaturas.edit', $a->id) }}">Editar</a>
                </td>
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
@push('js')
  <script src="{{ asset('vendors/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable();
    });
  </script>
@endpush
