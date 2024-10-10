@php
  $now = new \DateTime();
  $fecha = $now->format('Y-m-d');
  $hora = date('H:i');
@endphp
@extends('layouts.app')

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
    @slot('body', 'Espacio <strong>' . $e->nombre .'</strong>')
    @slot('route', route('admin.espacio.index'))
  @endcomponent
</div>

<div class="row">
  <div class="col-md-3">
    @include('admin.espacio._card_info')
  </div>
  <div class="col">
    @include('admin.espacio._navs')
    <div class="card text-start">
      <div class="card-body">
        <h4 class="card-title">Registro de clases

          <button class="btn app-btn-primary btn-xs"  data-bs-toggle="modal" data-bs-target="#newClase">Nueva clase</button>
        </h4>
        <div id='calendar'></div>
        <div class="table-responsive mt-3 card p-2">
          <table class="table app-table-hover table-sm mb-0 text-left">
            <thead>
              <tr>
                <th class="cell"></th>
                <th class="cell">Nombre</th>
                <th class="cell">Correo</th>
                <th class="cell"></th>
                <th class="cell"></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($e->clases as $c)
                <tr>
                  <td class="cell">
                    {{ $c->getDate()->getDateFormatEmail() }}
                    {{-- <img src="{{ asset($u->getPhoto()) }}" width="50" alt=""> --}}
                  </td>
                  {{-- <td class="cell">{{ $u->nombre_completo() }}</td> --}}
                  {{-- <td class="cell"><a href="{{ route('admin.usuario.show', $u->id) }}">{{ $u->correo }}</a></td> --}}
                  {{-- <td class="cell"></td> --}}
                  {{-- <td class="cell"></td> --}}
                </tr>
              @empty
                <tr>
                  <td class="cell text-center" colspan="5">No tienes usuarios matriculados</td>
                </tr>
              @endforelse
            </tbody>
          </table>
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
        <form class="settings-form row" action="{{ route('admin.espacio.clases', $e->id) }}" method="POST">
          @csrf
          <div class="mb-3 col-md-12">
            <label for="fecha" class="form-label">Fecha clase<small class="text-danger">*</small></label>
            <input type="date" id="fechaHora" class="form-control" name="fechaHora" value="{{ $fecha }}" required>
          </div>
          <div class="mb-3 col-md-6">
            <label for="fecha" class="form-label">Hora Inicio<small class="text-danger">*</small></label>
            <input type="time" id="fechaHora" class="form-control" name="fechaHora" value="{{ $fechaHoraActual }}" required>
          </div>
          <div class="mb-3 col-md-6">
            <label for="fecha" class="form-label">Hora Termino<small class="text-danger">*</small></label>
            <input type="time" id="fechaHora" class="form-control" name="fechaHora" value="{{ $fechaHoraActual }}" required>
          </div>
          <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn app-btn-primary" type="submit">Guardar</button>
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
