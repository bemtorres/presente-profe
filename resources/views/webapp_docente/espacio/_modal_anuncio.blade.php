
<div class="modal fade" id="modalAnuncio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      {{-- <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> --}}
      <div class="modal-body">
        <form class="settings-form row" action="{{ route('webappdocente.espacios.anuncio.store', $e->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3 col-md-12">
            <label for="titulo" class="form-label">Titulo<small class="text-danger">*</small></label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="" required>
          </div>

          <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control" name="mensaje" id="mensaje" name="mensaje" rows="5" required></textarea>
          </div>

          <div class="text-end">
            <button type="submit" class="btn app-btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
