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
  <div class="col-md-4">
    <h1>Asistencias</h1>
    <div class="card text-start">
      <div class="card-body">
        <div class="table-responsive ">
          <table class="table app-table-hover table-sm mb-0 text-left">
            <thead>
              <tr>
                <th class="cell"></th>
                <th class="cell"></th>
                {{-- <th class="cell">Date</th> --}}
                {{-- <th class="cell">Status</th> --}}
                {{-- <th class="cell">Total</th> --}}
                {{-- <th class="cell"></th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach ($m->asistencias as $a)
                @php
                  $u = $a->matricula->estudiante;
                @endphp
                <tr>
                  <td>
                    {{ $a->getDate()->getDayTextSP() }}
                  </td>
                  <td class="cell">
                    {{ $a->getDate()->getDateEuropa() }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col">
    <h1>Reporte inasistencia</h1>
    <div class="card text-start">
      <div class="card-body">
        <div class="table-responsive ">
          <table class="table app-table-hover table-sm mb-0 text-left">
            <thead>
              <tr>
                <th class="cell"></th>
                <th class="cell"></th>
                <th class="cell"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($m->reportes as $r)
                <tr>
                  <td>
                    {{ $a->getDate()->getDayTextSP() }}
                  </td>
                  <td class="cell">
                    {{ $a->getDate()->getDateEuropa() }}
                  </td>
                  <td class="cell">
                    {{ $r->mensaje }}
                  </td>
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




@endsection
@push('js')

@endpush
