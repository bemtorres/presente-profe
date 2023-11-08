<template>
  <div>
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
      <strong>Comparte duoc!</strong> <br>
      <small>¡Solicita una sala de manera rápida y sencilla!</small>
    </div>
    <div class="card shadow mb-3">
      <div class="row"  v-if="usuarioSeleccionado.img != null">
        <div class="col-md-4 mb-3 text-center">
          <img :src="usuarioSeleccionado.img" class="img-fluid rounded-start p-4" alt="...">
          <span class="badge bg-dark rounded-pill ms-2">{{ usuarioSeleccionado.sede }}</span>
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <p class="card-title">{{  usuarioSeleccionado.nombre_completo  }}</p>
            <small>{{ usuarioSeleccionado.run  }}</small>
            <small class="card-text">{{  usuarioSeleccionado.correo  }}</small>
            <div class="d-grid mt-3">
              <button class="btn btn-danger btn-sm rounded-5" @click="cambiarUsuario"><strong>Cambiar usuario</strong></button>
            </div>
          </div>
        </div>
      </div>
      <div class="row g-0" v-if="usuarioSeleccionado.img == null">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBuscarUsuario">
          Buscar usuario
        </button>
      </div>
    </div>
    <button ref="btnOpenModal" type="button" hidden data-bs-toggle="modal" data-bs-target="#modalBuscarUsuario"> </button>
    <div class="modal" id="modalBuscarUsuario">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Buscar usuario</h5>
            <button
              ref="btnCloseModal"
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
                v-on:keyup.enter="buscarUsuario"
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
              <div class="row overflow-auto scrollable" v-if="usuarios[0] != null" style="height: 500px;">
                <div class="col-12 mb-3" v-for="usuario, id in usuarios" :key="id">
                  <div class="card shadow">
                    <div class="row">
                      <div class="col-md-4">
                        <img :src="usuario.img" class="img-fluid rounded-start p-4" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <p class="card-title">{{  usuario.nombre_completo  }}</p>
                          <small>{{ usuario.run  }}</small>
                          <p class="card-text">{{  usuario.correo  }}</p>
                          <span class="badge bg-dark rounded-pill">{{ usuario.sede }}</span>
                          <div class="d-grid mt-3">
                            <button class="btn btn-success btn-sm rounded-5" @click="seleccionarUsuario(usuario)"><strong>SELECCIONAR</strong></button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, toRaw } from "vue";

import {postData} from '@/components/conexion/api.js';

const nombre = ref("");
const usuarios = ref([]);
const usuarioSeleccionado = ref({
  img: null
});

const btnOpenModal = ref(null);
const btnCloseModal = ref(null);

const props = defineProps({
  postBuscar: String("")
});

const buscarUsuario = () => {
  postData(props.postBuscar, { nombre: nombre.value })
    .then((data) => {
      usuarios.value = data;
    })
    .catch((error) => {
      console.log("error", error);
    });
};


const seleccionarUsuario = (usuario) => {
  window._USUARIO = toRaw(usuario);

  usuarioSeleccionado.value = usuario;
  usuarios.value = [];
  nombre.value = "";
  btnCloseModal.value.click();
};

const cambiarUsuario = () => {
  usuarioSeleccionado.value = {
    img: null
  };
  window._USUARIO = null;

  usuarios.value = [];
  nombre.value = "";
  btnOpenModal.value.click();
};
</script>
