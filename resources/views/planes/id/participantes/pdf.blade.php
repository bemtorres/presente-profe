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
@include('planes.id.participantes._tabs')
<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12 mb-4">
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
                <a href="{{ route('pdf.diponibilidad', [$plan->id, $asociado->id]) }}" class="btn btn-danger">VER PDF</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-body">
                <iframe src="{{ route('pdf.diponibilidad',[$plan->id, $asociado->id]) }}" style="width:100%; height:700px;" frameborder="0" ></iframe>
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
