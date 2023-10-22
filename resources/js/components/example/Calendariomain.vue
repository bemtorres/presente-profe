<template>
  <div>
    <p class="card-text d-flex justify-content-between align-items-center">
      <span>
        📅<strong>Calendario:</strong>
        <small>
          Registra tu calendario de disponibilidad horaria.
          <br>
          <strong>
            🟩 Disponible
            🟨 Posible disponibilidad
          </strong>
        </small>
      </span>

      <span>
        <button type="button" class="btn btn-sm btn-primary me-3" @click="accionEditable">
          Editar
          <span v-if="!editable" class="badge bg-danger">OFF</span>
          <span v-if="editable" class="badge bg-success">ON</span>
        </button>

        <button v-if="editable" class="btn btn-success btn-sm" id="btn-enviar" @click="updateCalendar">
          <span id="spinner-enviar" hidden>
            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
            <span role="status"> Guardando...</span>
          </span>
          <span id="text-guardar">Guardar</span>
        </button>
      </span>
    </p>
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-sm">
        <thead>
          <tr>
            <th scope=""></th>
            <th scope=""></th>
            <th class="text-center" v-for="semana, i in semanas" :key="i"><strong>{{  semana  }}</strong></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="horario, index in horarios" :key="index" class="">
            <td class="text-center"><strong>{{ index + 1 }}</strong></td>
            <td class="text-center"><small>{{ horario[0] + ' - ' + horario[1] }}</small></td>
            <td v-for="dia , index2 in dias" :key="dia + index2"
              @click="selectedHorario( dia + '-' + (index + 1))"
              :class="selectClases(dia + '-' + (index + 1))"
              class="item-selected"
            >
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
  import { isProxy, toRaw } from 'vue';

  export default {
    name: 'Calendario',
    props: {
      // editable: {
      //   type: Boolean,
      //   default: true,
      // },
      horarios: {
        type: Array,
        default: [],
      },
      myhorario: {
        type: Array,
        default: [],
      }
    },
    data() {
      return {
        semanas: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dias: ['L','M','X','J','V','S'],
        data: [],
        editable: false
      }
    },
    created() {
      if (this.myhorario.length > 0) {
        this.data = this.myhorario;
      } else {
        this.data = [];
      }

      if (isProxy(this.data) && this.editable){
        mainPushData(toRaw(this.data));
      }
    },
    methods: {
      selectedHorario(casilla) {
        if (!this.editable) { return; }

        var arreglo = casilla.split("-");
        var selecionado = {
          'id': casilla,
          'dia': arreglo[0],
          'modulo': arreglo[1],
          'estado': 1,
          'color': 'verde',
        }

        var obj = this.buscarPorId(selecionado.id);
        if (obj != null) {
          if (obj.color == 'verde') {
            obj.color = 'amarillo';
            obj.estado = 2;
            this.actualizarPorId(obj.id, obj);
          } else if (obj.color == 'amarillo') {
            this.eliminarPorId(obj.id);
          }
        } else {
          this.agregarObjeto(selecionado);
        }

        if (isProxy(this.data)){
          mainPushData(toRaw(this.data));
        }
      },
      selectClases(casilla) {
        var obj = this.buscarPorId(casilla);
        if (obj != null) {

          if (!this.editable) {
            return 'bg-dark';
          }

          if (obj.color == 'verde') {
            return 'bg-success';
          } else if (obj.color == 'amarillo') {
            return 'bg-warning';
          }
        } else {
          return '';
        }
      },
      agregarObjeto(objeto) {
        var existe = this.data.some(item => item.id === objeto.id);

        if (!existe) {
            this.data.push(objeto);
            return true; // Éxito
        }

        return false; // El objeto ya existe
      },
      buscarPorId(id) {
        var obj = this.data.find(item => item.id === id);
        return obj || null;
      },
      actualizarPorId(id, nuevoObjeto) {
        var index = this.data.findIndex(item => item.id === id);

        if (index !== -1) {
            this.data[index] = nuevoObjeto;
            return true; // Éxito
        }

        return false; // No se encontró el objeto
      },
      eliminarPorId(id) {
        var index = this.data.findIndex(item => item.id === id);

        if (index !== -1) {
            this.data.splice(index, 1);
            return true; // Éxito
        }

        return false; // No se encontró el objeto
      },
      accionEditable() {
        this.editable = !this.editable;
      },
      updateCalendar() {
        saveCalendario();
      }
    },
  }
</script>
