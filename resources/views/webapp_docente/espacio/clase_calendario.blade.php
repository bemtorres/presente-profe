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
<link href='{{ asset('vendors/fullcalendar-v4.4.0/core/main.css') }}' rel='stylesheet' />
<link href='{{ asset('vendors/fullcalendar-v4.4.0/bootstrap/main.css') }}' rel='stylesheet' />
<link href='{{ asset('vendors/fullcalendar-v4.4.0/timegrid/main.css') }}' rel='stylesheet' />
<link href='{{ asset('vendors/fullcalendar-v4.4.0/daygrid/main.css') }}' rel='stylesheet' />
<link href='{{ asset('vendors/fullcalendar-v4.4.0/list/main.css') }}' rel='stylesheet' />
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
        <div id='calendar'></div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal -->
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

<script src='{{ asset('vendors/fullcalendar-v4.4.0/core/main.js') }}'></script>
<script src='{{ asset('vendors/fullcalendar-v4.4.0/interaction/main.js') }}'></script>
<script src='{{ asset('vendors/fullcalendar-v4.4.0/bootstrap/main.js') }}'></script>
<script src='{{ asset('vendors/fullcalendar-v4.4.0/daygrid/main.js') }}'></script>
<script src='{{ asset('vendors/fullcalendar-v4.4.0/timegrid/main.js') }}'></script>
<script src='{{ asset('vendors/fullcalendar-v4.4.0/list/main.js') }}'></script>
<script src='{{ asset('vendors/fullcalendar-v4.4.0/bundle/locales-all.js') }}'></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      var date = new Date()
      var d    = date.getDate(),
          m    = date.getMonth(),
          y    = date.getFullYear()

      var Calendar = FullCalendar.Calendar;
      var calendarEl = document.getElementById('calendar');
      var calendar = new Calendar(calendarEl, {
        plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid','list'],
        header    : {
          left  : 'prev,next today',
          center: 'title',
          right : 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        navLinks: true, // can click day/week names to navigate views
        weekNumbers: true,
        weekNumbersWithinDays: true,
        weekNumberCalculation: 'ISO',
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        //Random default events
        events    : @json($calendario),
      });
      calendar.setOption('locale', 'es');
      calendar.render();
    });
  </script>
@endpush
