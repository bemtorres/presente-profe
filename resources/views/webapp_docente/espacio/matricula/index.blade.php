@extends('layouts.webapp_docente.app')
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
              @foreach ($e->matriculas as $m)
                @php
                    $u = $m->estudiante;
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
@endsection
@push('js')


@endpush
