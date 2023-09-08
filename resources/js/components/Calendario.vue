<template>
  <div>
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
  export default {
    name: 'Calendario',
    props: {
      horarios: {
        type: Array,
        default: [],
      },
    },
    data() {
      return {
        semanas: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dias: ['L','M','X','J','V','S'],
        calendario: {},
        mensaje: 'hola'
      }
    },
    methods: {
      selectedHorario(name) {
        console.log(this.calendario);
        // Comprueba si la celda ya tiene un color asignado
        if (this.calendario[name]) {
          // Si ya tiene color, cambia el color al siguiente en la secuencia
          if (this.calendario[name] == 'verde') {
            this.calendario[name] = 'amarillo';
          } else {
            // Si es amarillo o cualquier otro color, quita el color
            delete this.calendario[name];
          }
        } else {
          // Si la celda no tiene color, asigna el color verde
          this.calendario[name] = 'verde';
        }
      },
      selectClases(name) {
        if (this.calendario[name]) {
          if (this.calendario[name] === 'verde') {
            return 'bg-success';
          } else if (this.calendario[name] === 'amarillo') {
            return 'bg-warning';
          }
        } else {
          return '';
        }
      }
    },
  }
</script>
