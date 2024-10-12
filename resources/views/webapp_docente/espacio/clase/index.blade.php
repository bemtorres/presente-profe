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
    @slot('route', route('webappdocente.espacios.clases', $e->id))
  @endcomponent
</div>

<div class="row">
  <div class="col-md-2">
    @include('webapp_docente.espacio._card_info')


  </div>
  <div class="col">
    {{-- @include('webapp_docente.espacio._navs') --}}

    <div class="card">


      <div class="row">
        <div class="col-6 col-lg-3">
          <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
              <h4 class="stats-type mb-1">CODIGO QR</h4>
              <div id="qrcode" class="ps-5"></div>
              <div class="stats-figure">{{ $c->codigo_web }}</div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3">
          <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
              <h4 class="stats-type mb-1">Registrados</h4>
              <div class="stats-figure">{{ $c->asistencias->count() }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card text-start">
      <div class="card-body">
        <div class="table-responsive ">
          <table class="table app-table-hover table-sm mb-0 text-left">
            <thead>
              <tr>
                <th class="cell"></th>
                <th class="cell">Nombre</th>
                <th class="cell">Correo</th>
                {{-- <th class="cell">Date</th> --}}
                {{-- <th class="cell">Status</th> --}}
                {{-- <th class="cell">Total</th> --}}
                {{-- <th class="cell"></th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach ($c->asistencias as $a)
                @php
                  $u = $a->matricula->estudiante;
                @endphp
                <tr>
                  <td class="cell">
                    <img src="{{ asset($u->getPhoto()) }}" width="50" alt="">
                  </td>
                  <td class="cell">{{ $u->nombre_completo() }}</td>
                  <td>{{ $u->correo }}</td>
                  {{-- <td class="cell"><a href="{{ route('admin.usuario.show', $u->id) }}">{{ $u->correo }}</a></td> --}}
                  {{-- <td class="cell"><span>17 Oct</span><span class="note">2:16 PM</span></td> --}}
                  {{-- <td class="cell"><span class="badge bg-success">Paid</span></td> --}}
                  <td class="cell"></td>
                  {{-- <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td> --}}
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

<script src="{{ asset('vendors/qrcode.min.js') }}"></script>
<script type="text/javascript">
  var qrcode = new QRCode(document.getElementById("qrcode"), {
    text: '{{ $c->codigo_web }}',
    width: 80,
    height: 80,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.H
  });
  </script>
@endpush
