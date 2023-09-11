@extends('layouts.app')
@push('css')

<link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endpush
@section('content')
<h1 class="h3 mb-2 text-gray-800"><small>Plan Disponibilidad Horaria</small></h1>
@include('planes._tabs')
<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($planes as $p)
              <tr>
                <td>{{ $p->id }}</td>
                <td><a href="{{ route('planes.show', $p->id) }}">{{ $p->nombre }}</a></td>
                <td>{{ $p->descripcion }}</td>
                <td>
                  @if ($p->estado == 1)
                    <span class="badge bg-info">Edición</span>
                  @elseif ($p->estado == 2)
                    <span class="badge bg-primary">En proceso</span>
                  @elseif ($p->estado == 3)
                    <span class="badge bg-success">Finalizado</span>
                  @elseif ($p->estado == 10)
                    <span class="badge bg-danger">Borrado</span>
                  @endif
                </td>
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
