@extends('layouts.app')
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
        <h4 class="card-title">Usuarios matriculados</h4>
        {{-- <p class="card-text">Text</p> --}}

        <div class="row g-4 mb-4">
          <div class="col-6 col-lg-4">
            <div class="app-card app-card-stat shadow-sm h-100">
              <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type
                mb-1">Código de matricula</h4>
                <div class="stats-figure">{{ $e->codigo_matricula }}</div>
              </div>
              {{-- <a class="app-card-link-mask" href="#"></a> --}}
            </div>
          </div>
          <div class="col-4">
            <div class="mb-3">
              <label for="setting-input-2" class="form-label">Configuración</label>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="matriculaSwitch" {{ $e->matricula_activo ? 'checked' : ''  }}>
                <label class="form-check-label" for="matriculaSwitch">Habilitar matricula</label>
              </div>
              {{-- <div class="form-check mb-3">
                <button type="submit" class="btn btn-xs app-btn-primary">Guardar</button>
              </div> --}}
            </div>
          </div>
        </div>

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
              @forelse ($e->matriculas as $m)
                <tr>
                  <td class="cell">
                    <img src="{{ asset($u->getPhoto()) }}" width="50" alt="">
                  </td>
                  <td class="cell">{{ $u->nombre_completo() }}</td>
                  <td class="cell"><a href="{{ route('admin.usuario.show', $u->id) }}">{{ $u->correo }}</a></td>
                  <td class="cell"></td>
                  <td class="cell"></td>
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

@endsection

@push('js')
    <script>

      document.addEventListener('DOMContentLoaded', function() {
    const matriculaSwitch = document.getElementById('matriculaSwitch');

    matriculaSwitch.addEventListener('change', function() {
        const isChecked = this.checked;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('{{ route('admin.espacio.matricla.active', $e->id) }}', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                habilitarMatricula: isChecked
            }),
        })
        .then(response => response.json())
        .then(data => {
          console.log(data);
            Toastify({
                text: 'Matrícula ' + (isChecked ? 'activada' : 'desactivada') + ' correctamente',
                duration: 2000,
                close: true,
                gravity: "top", // `top` or `bottom`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: isChecked ? '#4caf50' : '#ff4d4d', // Verde si se activa, rojo si se desactiva
                },
            }).showToast();
        })
        .catch(error => {
            console.error('Error al cambiar la matrícula:', error);
            Toastify({
                text: "Error al realizar la operación",
                duration: 2000,
                close: true,
                gravity: "top",
                stopOnFocus: true,
                style: {
                    background: '#ff4d4d',
                },
            }).showToast();
        });
    });
});
</script>
@endpush
