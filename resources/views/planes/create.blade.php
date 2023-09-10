@extends('layouts.app')
@section('content')

<h1 class="h3 mb-2 text-gray-800"><small>Nuevo Plan Disponibilidad Horaria</small></h1>
@include('planes._tabs')
<div class="row">
  <div class="col-md-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form action="{{ route('planes.store') }}" method="POST">
          @csrf
          <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" required>
          </div>
          <div class="mb-3">
              <label for="sigla" class="form-label">Descripcion</label>
              <input type="text" class="form-control" id="descripcion" name="descripcion">
          </div>

          <div class="mb-3">
            <label for="" class="form-label">Estado</label>
            <select class="form-select" name="" id="">
              <option value="">New Delhi</option>
              <option value="">Istanbul</option>
              <option value="">Jakarta</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
