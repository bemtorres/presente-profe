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
    @slot('body', '<strong>Calendario de espacios</strong>')
    {{-- @slot('route', route('admin.espacio.index')) --}}
  @endcomponent
</div>

<div class="row">
  <div class="col">
    <div class="card text-start">
      <div class="card-body p-4">
          {{-- <button class="btn app-btn-primary btn-xs"  data-bs-toggle="modal" data-bs-target="#newClase">Nueva clase</button> --}}
        <div id='calendar'></div>
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
        events    : @json($calendarios),
      });
      calendar.setOption('locale', 'es');
      calendar.render();
    });
  </script>
@endpush
