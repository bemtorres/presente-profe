@extends('layouts.app')
@push('css')

<link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endpush
@section('content')
@component('components.button._back')
@slot('route', route('planes.show', $plan->id))
@slot('color', 'secondary')
@slot('body', '<small>Reporte - <strong>' . $plan->nombre . '</strong></small>')
@endcomponent
@include('planes._tabs_gestion')
<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Dia</th>
                <th>Horario</th>
                <th>Nombre</th>
                <th>Correo</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($horarios as $h)
              <tr>
                <td>
                  {{ $h->getDayText() }}
                </td>
                <td>
                  {{ $h->getHorario() }}
                </td>
                <td>
                  {{ $h->usuario->nombre_completo() }}
                </td>
                <td>
                  {{ $h->usuario->correo }}
                </td>
                {{-- <td>{{ $h->id }}</td> --}}
                {{-- <td><a href="{{ route('planes.show', $p->id) }}">{{ $p->nombre }}</a></td>
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
                </td> --}}
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
