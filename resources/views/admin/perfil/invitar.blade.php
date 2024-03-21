@extends('layouts.app')
@section('content')
<div class="row g-3 mb-4 align-items-center justify-content-between">
  @component('components.button._back')
  @slot('body', 'Mi perfil')
  {{-- @slot('route', route('admin.usuario.index')) --}}
  @endcomponent
</div>

<div class="row g-4 settings-section">
  @include('admin.perfil._tabs')
  <div class="col-12 col-md-12">

    <div class="row g-4 settings-section">
      <div class="col-12 col-md-4">
        <h3 class="section-title">Invitaciones</h3>
        <div class="section-intro">Settings section intro goes here. Duis velit massa, faucibus non hendrerit eget.
        </div>
      </div>
      <div class="col-12 col-md-8">
        <div class="app-card app-card-settings shadow-sm p-4">
          <div class="app-card-body">
            <div class="alert alert-success" role="alert">
              <strong>Cantidad de invitados </strong> 0
            </div>

            <div class="mb-3 col-md-12">
              <label for="nombre" class="form-label">Codigo de invitación</label>
              <input type="text" value="{{ $u->codigo_invitacion }}" class="form-control" readonly>
            </div>
            <div class="mt-3 text-end">
              <form action="{{ route('admin.perfil.codigo') }}" method="post">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-info">Generar nuevo código de invitación</button>
              </form>
            </div>
          </div>
        </div>
        <div class="app-card app-card-settings shadow-sm p-4 mt-3">
          <div class="app-card-body">
            <form class="" action="{{ route('admin.perfil.invitar') }}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="invitar" name="check-invitar" {{ $u->getInfoInvitar() ? 'checked' : '' }}>
                <label class="form-check-label" for="invitar">Permitir invitaciones</label>
              </div>


              <div class="mt-3 text-end">
                <button type="submit" class="btn app-btn-primary">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


  </div>

</div>
@endsection
@push('js')
<script src="{{ asset('vendors/bemtorres/validate-run.js') }}"></script>

@endpush
