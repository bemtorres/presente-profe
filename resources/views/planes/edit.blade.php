
@extends('layouts.app')
@section('content')

<form action="{{ route('asignaturas.update', $asignatura->id) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="mb-3">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $asignatura->nombre }}">
  </div>
  <div class="mb-3">
      <label for="sigla" class="form-label">Sigla</label>
      <input type="text" class="form-control" id="sigla" name="sigla" value="{{ $asignatura->sigla }}">
  </div>
  <div class="mb-3">
      <label for="carrera" class="form-label">Carrera</label>
      <input type="text" class="form-control" id="carrera" name="carrera" value="{{ $asignatura->carrera }}">
  </div>
  <button type="submit" class="btn btn-primary">Guardar Cambios</button>
</form>

@endsection
