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
                  <label for="apellido_paterno" class="form-label">Apellido Paterno<small class="text-danger">*</small></label>
                  <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" value="{{ $u->apellido_paterno }}" required>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="apellido_materno" class="form-label">Apellido Materno</label>
                  <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" value="{{ $u->apellido_materno }}">
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
        <div class="col-12 col-md-4">
          <div class="app-card app-card-settings shadow-sm p-4 mt-3">
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

      {{-- <hr class="my-4">
      <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
          <h3 class="section-title">Data &amp; Privacy</h3>
          <div class="section-intro">Settings section intro goes here. Morbi vehicula, est eget fermentum
            ornare. </div>
        </div>
        <div class="col-12 col-md-8">
          <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">
              <form class="settings-form">

                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-2" checked>
                  <label class="form-check-label" for="settings-checkbox-2">
                    Keep user app preferences
                  </label>
                </div>
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-3">
                  <label class="form-check-label" for="settings-checkbox-3">
                    Keep user app search history
                  </label>
                </div>
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-4">
                  <label class="form-check-label" for="settings-checkbox-4">
                    Lorem ipsum dolor sit amet
                  </label>
                </div>
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-5">
                  <label class="form-check-label" for="settings-checkbox-5">
                    Aenean quis pharetra metus
                  </label>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn app-btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <hr class="my-4">
      <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
          <h3 class="section-title">Notifications</h3>
          <div class="section-intro">Settings section intro goes here. Duis velit massa, faucibus non
            hendrerit eget.</div>
        </div>
        <div class="col-12 col-md-8">
          <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">
              <form class="settings-form">
                <div class="form-check form-switch mb-3">
                  <input class="form-check-input" type="checkbox" id="settings-switch-1" checked>
                  <label class="form-check-label" for="settings-switch-1">Project
                    notifications</label>
                </div>
                <div class="form-check form-switch mb-3">
                  <input class="form-check-input" type="checkbox" id="settings-switch-2">
                  <label class="form-check-label" for="settings-switch-2">Web browser push
                    notifications</label>
                </div>
                <div class="form-check form-switch mb-3">
                  <input class="form-check-input" type="checkbox" id="settings-switch-3" checked>
                  <label class="form-check-label" for="settings-switch-3">Mobile push
                    notifications</label>
                </div>
                <div class="form-check form-switch mb-3">
                  <input class="form-check-input" type="checkbox" id="settings-switch-4">
                  <label class="form-check-label" for="settings-switch-4">Lorem ipsum
                    notifications</label>
                </div>
                <div class="form-check form-switch mb-3">
                  <input class="form-check-input" type="checkbox" id="settings-switch-5">
                  <label class="form-check-label" for="settings-switch-5">Lorem ipsum
                    notifications</label>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn app-btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <hr class="my-4"> --}}

  {{-- </div> --}}
{{-- </div> --}}
@endsection
@push('js')
  <script src="{{ asset('vendors/bemtorres/validate-run.js') }}"></script>

@endpush
