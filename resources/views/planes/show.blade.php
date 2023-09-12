@extends('layouts.app')
@push('css')

<link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endpush
@section('content')
@component('components.button._back')
@slot('route', route('planes.index'))
@slot('color', 'secondary')
@slot('body', '<small>Disponibilidad Horaria - <strong>' . $plan->nombre . '</strong>  <a class="btn btn-outline-primary btn-sm" style="--cui-btn-padding-y: .25rem; --cui-btn-padding-x: .5rem; --cui-btn-font-size: .75rem;" href="'. route('planes.edit', $plan->id) .'"><i class="fa fa-edit"></i>Editar</a></small>')
@endcomponent
@include('planes._tabs_gestion')
<div class="card shadow mb-4">
  <div class="row p-2">
    <div class="col-md-3">
      <div class="card">
        <img src="{{ asset('app/teamwork-3213924_640.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{ $plan->nombre }}</h5>
          <p class="card-text">{{ $plan->descripcion }}</p>

          <ul class="list-group list-group-flush">
            {{-- <li class="list-group-item">
              <i class="fa fa-users"></i> 10 participantes
            </li>
            <li class="list-group-item">
              <i class="fa fa-users"></i> 5 pendientes
            </li>
            <li class="list-group-item">
              <i class="fa fa-users"></i> 10 participantes
            </li> --}}
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <p class="card-text">📖 Asignaturas</p>
          <ul class="list-group list-group-flush">
            @foreach ($plan->detalle_plan as $dp)
              <li class="list-group-item">
                {{ $dp->asignatura->toString() }}
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
              </tr>
            </thead>
            <tbody>

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
