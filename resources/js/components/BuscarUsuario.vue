<template>
  <div>
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Buscar usuario</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="input-group mb-3">
              <input
                type="text"
                class="form-control"
                placeholder="Buscar por apellido o por RUN 11222333K..."
                aria-label="Buscar..."
                v-model="nombre"
                aria-describedby="basic-addon2"
              />
              <button
                class="btn btn-primary"
                type="button"
                id="basic-addon2"
                @click="buscarUsuario"
              >
                <i class="fa fa-search"></i>
              </button>
            </div>

            <div class="container">
              <div class="row">
                <div class="col-12 mb-3">
                  <div class="card rounded-5 shadow">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4">
                          <img
                            src="image/tracks/realidadvirtual.svg"
                            style="height: 100px"
                            alt=""
                            class="rounded-circle img-thumbnail"
                          />
                        </div>
                        <div class="col-md-8">
                          <h5 class="mb-1">Desarrollo de proyecto</h5>
                          <p>Docente Benjamin Mora</p>
                          <p><small>bej.mora@profesor.duoc.cl</small></p>
                          <div class="d-grid mt-2 px-3">
                            <button
                              class="btn btn-primary btn-sm"
                              data-bs-toggle="modal"
                              data-bs-target="#inscripcionModal"
                            >
                              Inscribirse
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div  class="table-responsive">
              <table class="table table-hover table-bordered table-sm">
                <thead>
                  <tr class="bg-primary">
                    <th scope="col">RUN</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">CORREO</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

import {postData} from './conexion/api.js';

const isModalVisible = ref(false);
const nombre = ref("");
const usuarios = ref([]);

const props = defineProps({
  postBuscar: String(""),
});

const showModal = () => {
  // isModalVisible.value = !isModalVisible;
  isModalVisible.value = !isModalVisible.value;
  console.log(isModalVisible.value);
};

const buscarUsuario = () => {
  // console.log("buscarUsuario", nombre.value);
  postData(props.postBuscar, { nombre: nombre.value })
    .then((data) => {
      console.log("data", data);
      usuarios.value = data;
    })
    .catch((error) => {
      console.log("error", error);
    });
};
</script>
