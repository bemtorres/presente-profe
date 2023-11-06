
@extends('layouts.app')
@push('css')

<link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endpush
@section('content')
<div class="container-fluid">
  @component('components.button._back')
    @slot('route', route('utils.index'))
    @slot('color', 'secondary')
    @slot('body', 'Carga masiva de calendario')
  @endcomponent
  <div class="card shadow mb-4">
    <div class="card-body row">
      <div class="col-md-6">
        <div class="card shadow mb-3">
          <div class="card-body">
            <form class="form-sample form-submit" action="{{ route('utils.calendario') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row mb-3">
                <div class="col-md-12 mb-3">
                  <label for="sede">Sede<small class="text-danger">*</small></label>
                  <select class="form-control" id="sede" name="sede">
                    @foreach ($sedes as $s)
                      <option value="{{ $s->id }}">{{ $s->nombre }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-12 mb-3">
                  <label for="semestre">Semestres<small class="text-danger">*</small></label>
                  <select class="form-control" id="semestre" name="semestre">
                    @foreach ($semestres as $semestre)
                      <option value="{{ $semestre->periodo }}">{{ $semestre->nombre }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="mb-3">
                  <label for="excel_file" class="form-label">Archivo<small class="text-danger">*</small></label>
                  <input class="form-control" type="file" id="excel_file" name="excel_file" required>
                </div>
              </div>
              <div class="form-group d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>
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
