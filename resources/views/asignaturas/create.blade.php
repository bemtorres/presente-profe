@extends('layouts.app')
@section('content')

<h1 class="h3 mb-2 text-gray-800">Asignaturas</h1>
@include('asignaturas._tabs')
<div class="row">
  <div class="col-md-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form action="{{ route('asignaturas.store') }}" method="POST">
          @csrf
          <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre">
          </div>
          <div class="mb-3">
              <label for="sigla" class="form-label">Sigla</label>
              <input type="text" class="form-control" id="sigla" name="sigla">
          </div>
          <div class="mb-3">
            <label for="" class="form-label">City</label>
            <select class="form-select" name="" id="">
              <option value="">New Delhi</option>
              <option value="">Istanbul</option>
              <option value="">Jakarta</option>
            </select>
          </div>
          <div class="mb-3">
              <label for="carrera" class="form-label">Carrera</label>
              select
              <input type="text" class="form-control" id="carrera" name="carrera">
          </div>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
