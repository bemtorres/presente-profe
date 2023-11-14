
@extends('layouts.app')
@push('css')

<link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endpush
@section('content')
<div class="container-fluid">
  @component('components.button._back')
    @slot('route', route('semestres.index'))
    @slot('color', 'secondary')
    @slot('body', 'Semestre ' . $s->nombre . ' - ' . $s->periodo)
  @endcomponent
  <div class="card shadow mb-4">
    <div class="card-body row">

      <div class="col-md-4">
        <div class="card text-start">
          {{-- <img class="card-img-top" src="holder.js/100px180/" alt="Title"> --}}
          <div class="card-body">
            <h4 class="card-title">Semestre</h4>
            <p class="card-text">{{ $s->nombre }}</p>
            <span class="badge bg-success">{{ $s->periodo }}</span>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="list-group">
          @foreach ($s->semanas as $semana)
            <div class="list-group-item list-group-item-action">
              {{ $semana->getInfo() }}
            </div>
          @endforeach
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
