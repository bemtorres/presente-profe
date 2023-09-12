@extends('layouts.app')
@push('css')

{{-- <link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}

@endpush
@section('content')
@component('components.button._back')
@slot('route', route('planes.show', $plan->id))
@slot('color', 'secondary')
@slot('body', '<small>Inscritos - <strong>' . $plan->nombre . '</strong></small>')
@endcomponent
@include('planes._tabs_gestion')
<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="mb-3">

          <a href="{{ route('planes.participantesAdd',$plan->id) }}" class="btn btn-primary btn-sm">Inscribir usuario</a>

        </div>
        <div class="table-responsive">
          <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Participantes</th>
                <th>Estado</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($plan->asociado_plan as $asociado)
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <img
                        src="{{ $asociado->usuario->getImg() }}"
                        alt=""
                        style="width: 45px; height: 45px"
                        class="rounded-circle"
                        />
                    <div class="ms-3">
                      <p class="fw-bold mb-1">{{ $asociado->usuario->nombre_completo() }}</p>
                      <p class="text-muted mb-0">{{ $asociado->usuario->correo }}</p>
                    </div>
                  </div>
                </td>
                <td>
                  {{-- <span class="badge bg-primary">New</span> --}}
                  {{-- <span class="badge bg-danger">New!</span> --}}
                  {{-- <span class="badge bg-warning">Pendiente</span> --}}
                  {{-- <span class="badge bg-success">OK</span> --}}
                </td>
                <td>
                  <a href="{{ route('planes.participantes.show',[$plan->id, $asociado->id]) }}" class="btn btn-success btn-sm">Ver</a>
                </td>
                <td></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  {{-- <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Buscar usuario</h6>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div> --}}
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
