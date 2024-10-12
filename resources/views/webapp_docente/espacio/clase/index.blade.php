@php
  use Carbon\Carbon;

  $now = new \DateTime();
  $fecha = $now->format('Y-m-d');
  $hora = date('H:i');

  $fechaHoraActual = Carbon::now()->format('Y-m-d\TH:i');
@endphp
@extends('layouts.webapp_docente.app')
{{-- @extends('layouts.app') --}}
@push('css')

@endpush
@section('content')

<div class="row g-3 mb-4 align-items-center justify-content-between">
  @component('components.button._back')
    @slot('body', "Espacio <strong> $e->nombre </strong>")
    @slot('route', route('webappdocente.index'))
  @endcomponent
</div>

<div class="row">
  <div class="col-md-2">
    @include('webapp_docente.espacio._card_info')
  </div>
  <div class="col">
    @include('webapp_docente.espacio._navs')
    <div class="card text-start">
      <div class="card-body">
        <h4 class="card-title">Registro de clases
          <button class="btn app-btn-primary btn-xs"  data-bs-toggle="modal" data-bs-target="#newClase">Nueva clase</button>
        </h4>

        <div class="table-responsive ">
          <table class="table app-table-hover table-sm mb-0 text-left">
            <thead>
              <tr>
                <th class="cell">Dia</th>
                <th class="cell">Fecha</th>
                <th class="cell">Cantidad</th>
                <th class="cell"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($e->clases as $c)
                <tr>
                  <td>
                    {{ $c->getDate()->getDayTextSP() }}
                  </td>
                  <td class="cell">
                    {{-- <img src="{{ asset($u->getPhoto()) }}" width="50" alt=""> --}}
                    {{ $c->getDate()->getDateEuropa() }}
                  </td>
                  <td class="cell"><a class="btn-sm btn btn-secondary" href="{{ route() }}">View</a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="newClase" tabindex="-1" aria-labelledby="newClaseLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="newClaseLabel">Nueva clase</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="settings-form row" action="{{ route('webappdocente.clases.store', $e->id) }}" method="POST">
          @csrf
          <div class="mb-3 col-md-12">
            <label for="fecha" class="form-label">Fecha clase<small class="text-danger">*</small></label>
            <input type="date" id="fechaHora" class="form-control" name="fecha" value="{{ $fecha }}" required>
          </div>
          <div class="mb-3 col-md-6">
            <label for="fecha" class="form-label">Hora Inicio<small class="text-danger">*</small></label>
            <input type="time" id="fechaHora" class="form-control" name="hora_inicio" value="{{ $hora }}" required>
          </div>
          <div class="mb-3 col-md-6">
            <label for="fecha" class="form-label">Hora Termino<small class="text-danger">*</small></label>
            <input type="time" id="fechaHora" class="form-control" name="hora_termino" value="{{ $hora }}" required>
          </div>
          <div class="d-grid gap-2 mx-auto">
            <button class="btn app-btn-primary btn-lg" type="submit">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
@push('js')


@endpush
