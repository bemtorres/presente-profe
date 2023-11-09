
@extends('layouts.app')
@push('css')

<link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endpush
@section('content')
<div class="container-fluid">
  @component('components.button._back')
    @slot('route', route('utils.index'))
    @slot('color', 'secondary')
    @slot('body', 'Correo electrónico')
  @endcomponent
  <div class="card shadow mb-4">
    <div class="card-body row">
      <div class="col-md-4">
        <div class="list-group">
          <a href="{{ route('sedes.index') }}" class="list-group-item list-group-item-action">Sedes</a>
          <a href="{{ route('semestres.index') }}" class="list-group-item list-group-item-action">Semestre</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="list-group">
          <a href="{{ route('utils.calendario') }}" class="list-group-item list-group-item-action">Carga Masiva Calendario</a>
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
