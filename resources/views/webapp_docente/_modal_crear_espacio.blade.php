
<div class="modal fade" id="modalUnirse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      {{-- <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> --}}
      <div class="modal-body">
        <form class="settings-form row" action="{{ route('webappdocente.espacios.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3 col-md-12">
            <label for="nombre" class="form-label">Nombre espacio<small class="text-danger">*</small></label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="" required>
          </div>
          <div class="mb-3 col-md-12">
            <label for="nombre" class="form-label">Sigla<small class="text-danger">*</small></label>
            <input type="text" class="form-control" id="sigla" name="sigla" value="" placeholder="DYP2002" required>
          </div>

          <div class="mb-3 col-md-12">
            <label for="institucion" class="form-label">Institución</label>
            <input type="text" class="form-control" id="institucion" name="institucion" value="" required>
          </div>

          <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion" name="descripcion" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label class="col-form-label" for="hf-rut">Imagen <small>(Opcional)</small></label>
            <div class="input-group">
              <!-- <img src=""  class='Responsive image img-thumbnail'  width='200px' height='200px' alt=""> -->
              <input type="file" class="form-control" name="image" accept="image/*" onchange="preview(this)" />
              <br>
            </div>
          </div>
          <div class="form-group text-center mb-3">
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
