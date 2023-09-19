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
  <div class="col-12">

    <div class="card">
      <div class="card-body row">

          <div class="col-md-4">
            <div class="card">
              <div class="card-body">

                <div class="list-group">
                  <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                    The current link item
                  </a>
                  <a href="#" class="list-group-item list-group-item-action">A second link item</a>
                  <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                  <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                  <a class="list-group-item list-group-item-action disabled" aria-disabled="true">A disabled link item</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card">
              <div class="card-body">

                <div class="list-group">
                  <a href="{{ route('planes.pdf', $plan->id) }}" class="list-group-item list-group-item-action"><i class="fa fa-file-pdf text-danger"></i> PDF Disponibilidad General</a>
                  <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                  <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>

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
