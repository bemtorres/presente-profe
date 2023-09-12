@extends('layouts.app')
@push('css')

{{-- <link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}

@endpush
@section('content')
@component('components.button._back')
@slot('route', route('planes.participantes', $plan->id))
@slot('color', 'secondary')
@slot('body', '<small>Participante - <strong>' . $plan->nombre . '</strong></small>')
@endcomponent
{{-- @include('planes._tabs_gestion') --}}
<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="card mb-4">
              <div class="card-body">

                <div class="col-md-12 mb-3">
                  <div class="d-flex align-items-center">
                    <div class="avatar avatar-md">
                      <img class="avatar-img" src="{{ $u->getImg() }}" alt="">
                    </div>
                    <div class="ms-2">
                      <span class="h6 mt-2 mt-sm-0">{{ $u->nombre_completo() }}</span>
                      <p class="small m-0">{{ $u->correo }}</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <p class="card-text">📖 <strong>Mis asignaturas</strong></p>
                <ul class="list-group list-group-flush">
                  @forelse ($asignaturas_preferidas as $ap)
                    <li class="list-group-item">
                      {{ $ap->asignatura->toString() }}
                    </li>
                  @empty
                    <li class="list-group-item">
                      No hay asignaturas
                    </li>
                  @endforelse
                </ul>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-body">
                <p class="card-text d-flex justify-content-between align-items-center">
                  <span>
                    📅<strong>Calendario:</strong>
                    <small>
                      Registra tu calendario de disponibilidad horaria.
                      <br>
                      <strong>
                        🟩 Disponible
                        🟨 Posible disponibilidad
                      </strong>
                    </small>
                  </span>
                </p>
                <calendario :horarios=@json($horarios) :myhorario=@json($my_horario) :editable="false"></calendario>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')

@endpush
