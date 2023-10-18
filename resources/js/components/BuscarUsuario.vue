<template>
  <div>
    <div class="list-group cursor">
      <div
        class="list-group-item d-flex justify-content-between align-items-center"
        id="mostrarLista"
      >
        <div class="d-flex align-items-center">
          <div class="d-flex align-items-center">
            <div class="avatar avatar-md">
              <img class="avatar-img" src="http://planificador.test/app/img/people.png" alt="" />
            </div>
            <div class="ms-2">
              <span class="h6 mt-2 mt-sm-0">admin admin</span>
              <p class="small m-0">admin@gmail.com</p>
            </div>
          </div>
        </div>
        <div class="">
          <button
            type="button"
            class="btn btn-primary btn-sm rounded-4"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
          >
            <strong>INGRESAR</strong>
          </button>
          <button class="btn btn-danger btn-sm rounded-4"><strong>SALIR</strong></button>
        </div>
      </div>
    </div>



<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <div
      class="modal fade show"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">...</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

</script>
