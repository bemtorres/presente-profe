@extends('layouts.app')
@push('css')

{{-- <link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}

@endpush
@section('content')
@component('components.button._back')
@slot('route', route('planes.show', $plan->id))
@slot('color', 'secondary')
@slot('body', '<small>Reporte - <strong>' . $plan->nombre . '</strong></small>')
@endcomponent
@include('planes._tabs_gestion')
<div class="row">

  @foreach ($plan->detalle_plan as $dp)

    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <small class="badge rounded-pill text-bg-primary">Semestre {{ $dp->asignatura->semestre }}</small> <br>
          <strong class="card-title">{{ $dp->asignatura->nombre }}</strong>
          <p class="card-text">{{ $dp->asignatura->sigla }}</p>
          <!-- Hover added -->
          <div class="list-group">
            @foreach ($users_asignaturas as $ua)
            @if ($ua->id_asignatura == $dp->asignatura->id)
                <span class="list-group-item list-group-item-action" aria-current="true">
                    <small>{{ $ua->usuario->nombre_completo() }}</small>
                </span>
            @endif
            @endforeach
          </div>
        </div>
      </div>
    </div>
  @endforeach

</div>
@endsection
@push('js')
  {{-- <script src="{{ asset('vendors/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable();
    });
  </script> --}}
@endpush
