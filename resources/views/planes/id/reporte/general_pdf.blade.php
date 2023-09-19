@extends('layouts.app')
@push('css')

{{-- <link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}

@endpush
@section('content')
@component('components.button._back')
@slot('route', route('planes.reporte', $plan->id))
@slot('color', 'secondary')
@slot('body', '<small>Reporte - <strong>' . $plan->nombre . '</strong></small>')
@endcomponent
{{-- @include('planes._tabs_gestion') --}}
<div class="row">
  <div class="col-12">

    <div class="card">
      <div class="card-body">
        <iframe src="{{ route('pdf.diponibilidad_general',$plan->id) }}" style="width:100%; height:700px;" frameborder="0" ></iframe>
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
