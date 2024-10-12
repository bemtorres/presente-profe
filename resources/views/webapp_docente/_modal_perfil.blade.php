<div class="modal fade" id="modalPerfilPassword" tabindex="-1" aria-labelledby="modalPerfilLbel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      {{-- <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> --}}
      <div class="modal-body">
        <form action="{{ route('admin.perfil.password') }}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label for="pass" class="form-label">Cambiar contraseña <small class="text-danger">máx 10 carácteres</small></label>
            <input type="text" class="form-control" id="pass" name="pass" maxlength="10">
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success text-white" type="button">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalPerfil" tabindex="-1" aria-labelledby="modalPerfilLbel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      {{-- <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> --}}
      <div class="modal-body">
        <div class="row mb-3">
          <div class="col-12 justify-center text-center">
            <img src="{{ asset(current_user()->getPhoto() )}}" height="100px" width="100px" class="rounded-circle" alt="">
          </div>
        </div>
        <div class="mb-2 row">
          <label for="code" class="form-label col-3">Nombre</label>
          <div class="col-9">
            <input type="text" class="form-control" disabled value="{{ current_user()->nombre_completo() }}">
          </div>
        </div>
        <div class="mb-2 row">
          <label for="code" class="form-label col-3">Run</label>
          <div class="col-9">
            <input type="text" class="form-control" disabled value="{{ current_user()->run }}">
          </div>
        </div>
        <div class="mb-2 row">
          <label for="code" class="form-label col-3">Correo</label>
          <div class="col-9">
            <input type="text" class="form-control" disabled value="{{ current_user()->correo }}">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
