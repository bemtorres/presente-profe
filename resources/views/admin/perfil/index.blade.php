@extends('layouts.app')
@section('content')
<div class="row g-3 mb-4 align-items-center justify-content-between">
  @component('components.button._back')
  @slot('body', 'Mi perfil')
  {{-- @slot('route', route('admin.usuario.index')) --}}
  @endcomponent
</div>

{{-- <div class="card text-start"> --}}
  {{-- <div class="card-body"> --}}
      <div class="row g-4 settings-section">
        {{-- <div class="col-12 col-md-4">
          <h3 class="section-title">Inscripción de usuario</h3>
          <div class="section-intro"></div>
        </div> --}}
        @include('admin.perfil._tabs')
      </div>

      <hr class="my-4">
      <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
          <h3 class="section-title">Información cuenta</h3>
          <div class="section-intro">Settings section intro goes here. Morbi vehicula, est eget fermentum
            ornare. </div>
        </div>
        <div class="col-12 col-md-8">
          <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body">
              <form class="settings-form row" action="{{ route('admin.perfil.update',$u->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3 col-md-12">
                  <label for="run" class="form-label">Rut<small class="text-danger">*</small></label>
                  <input type="text" class="form-control" name="run" placeholder=""
                      required="" maxlength="9" min="8" autocomplete="off" value="{{ $u->run }}" onkeyup="this.value = validarRut(this.value)">
                </div>
                {{-- <hr class="my-3"> --}}
                <div class="mb-3 col-md-12">
                  <label for="nombre" class="form-label">Nombre<small class="text-danger">*</small></label>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $u->nombre }}" required>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="apellido" class="form-label">Apellido<small class="text-danger">*</small></label>
                  <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $u->apellido }}" required>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="correo" class="form-label">Correo<small class="text-danger">*</small></label>
                  <input type="email" class="form-control" id="correo" name="correo" value="{{ $u->correo }}"required>
                </div>
                @if ($u->admin)
                <div class="mb-3">
                  <label for="setting-input-2" class="form-label">Configuración</label>
                  <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="check-admin" id="admin" {{ $u->admin ? 'checked' : '' }}>
                    <label class="form-check-label" for="admin">
                      Administrador
                    </label>
                  </div>
                  <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="check-premium" id="premium" {{ $u->premium ? 'checked' : '' }}>
                    <label class="form-check-label" for="premium">
                      Premium User
                    </label>
                  </div>
                </div>
                @endif

                <div class="text-end">
                  <button type="submit" class="btn app-btn-primary">Guardar</button>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <hr class="my-4">
      <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
          <h3 class="section-title">Cambiar contraseña</h3>
          <div class="section-intro">Settings section intro goes here. Duis velit massa, faucibus non
            hendrerit eget.</div>
        </div>
        <div class="col-12 col-md-8">
          <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">
              <form class="settings-form row" action="{{ route('admin.perfil.password',$u->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3 col-md-12">
                  <label for="pass" class="form-label">Contraseña<small class="text-danger">*</small></label>
                  <input type="password" class="form-control" id="pass" name="pass" value="" required>
                </div>

                <div class="text-end">
                  <button type="submit" class="btn app-btn-primary">Guardar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <hr class="my-4">
      <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
          <h3 class="section-title">Cambiar Imagen</h3>
          <div class="section-intro">
            <img src="{{ asset($u->getPhoto()) }}" width="200" height="100%" alt="">
          </div>

        </div>
        <div class="col-12 col-md-8">
          <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">

              <form class="settings-form row" action="{{ route('admin.perfil.img',$u->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                  <label class="col-form-label" for="hf-rut">Imagen <small>(Opcional)</small></label>
                  <div class="input-group">
                    <!-- <img src=""  class='Responsive image img-thumbnail'  width='200px' height='200px' alt=""> -->
                    <input type="file" name="image" accept="image/*" onchange="preview(this)" />
                    <br>
                  </div>
                </div>
                <div class="form-group center-text">
                  <div id="preview"></div>
                </div>

                <div class="text-end">
                  <button type="submit" class="btn app-btn-primary">Guardar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  {{-- </div> --}}
{{-- </div> --}}
@endsection
@push('js')
  <script src="{{ asset('vendors/bemtorres/validate-run.js') }}"></script>
  <script src="{{ asset('vendors/bemtorres/preview.js') }}"></script>
@endpush
