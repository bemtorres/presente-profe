<template>
  <div class="row">
    <div class="col-md-12 row">
      <div class="col-md-3">
        <div class="form-group mb-3">
          <label for="">Seleccionar sala</label>
          <select class="form-control" v-model="vsala" @change="handleSelectChange">
            <option v-for="sala, j in salas" :key="j" :value="sala">
              {{ sala.nombre }}
            </option>
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <button class="btn btn-primary btn-sm">Editar</button>
        <button class="btn btn-primary btn-sm" @click="handleAddHorario">Guardar</button>
      </div>
    </div>
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm">
          <thead>
            <tr>
              <th colspan="2" style="width:10px">
                Seleccione la semana a programar
              </th>
              <th class="text-center" v-for="(semana, i) in semanas" :key="i">
                <strong>{{ semana }}</strong>
              </th>
            </tr>
            <tr>
              <th colspan="2">
                <select class="form-control" name="" id="" v-model="vsemana" @change="handleSelectChange">
                  <option v-for="sd, k in semanasdetall" :value="sd" :key="k">
                    {{ sd.info }}
                  </option>
                </select>
              </th>
              <th class="text-center" v-for="fecha in fechaSiguiente" :key="fecha">
                {{ fecha }}
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(horario, index) in props.horarios" :key="index" class="">
              <td class="text-center">
                <strong>{{ index + 1 }}</strong>
              </td>
              <td class="text-center">
                <small>{{ horario[0] + " - " + horario[1] }}</small>
              </td>
              <td
                v-for="(dia, index2) in dias"
                :key="dia + index2"
                @click="selectedHorario(dia + '-' + (index + 1))"
                :class="selectClases(dia + '-' + (index + 1))"
                class="item-selected"
              ></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { ref, isProxy, toRaw, onMounted } from "vue";
  import { postData } from './conexion/api.js';
  import { calcularFechasSiguientes } from './lib/index.js';

  const props = defineProps({
    editable: Boolean(false),
    horarios: Array,
    myhorario: Array,
    salas: Array,
    semestre: {},
    semanasdetall: {},
    alertmensaje: function () {},
    postBuscarCalendario: String,
    postStoreCalendario: String
  });

  const semanas = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
  const dias = ["L", "M", "X", "J", "V", "S"];
  const fechaSiguiente = ref([]);
  const data = ref([]);
  const vsala = ref("");
  const vsemana = ref("");

  const initializeData = () => {
    // console.log("semestre", props.semanasdetall);

    if (props.myhorario.length > 0) {
      data.value = props.myhorario;
    } else {
      data.value = [];
    }

    if (props.semanasdetall.length > 0) {
      vsemana.value = props.semanasdetall[0];
    }

    if (props.salas.length > 0) {
      vsala.value = props.salas[0];
    }

    fechaSiguiente.value = calcularFechasSiguientes(vsemana.value.fecha_inicio);
  };

  onMounted(() => {
    initializeData();
  });

  const selectedHorario = (casilla) => {
    if (!props.editable) {
      return;
    }

    var arreglo = casilla.split("-");
    var selecionado = {
      id: casilla,
      dia: arreglo[0],
      modulo: arreglo[1],
      estado: 1,
      color: "verde",
    };

    var obj = buscarPorId(selecionado.id);
    if (obj != null) {
      if (obj.color == "verde") {
        obj.color = "amarillo";
        obj.estado = 2;
        actualizarPorId(obj.id, obj);
      } else if (obj.color == "amarillo") {
        eliminarPorId(obj.id);
      } else if (obj.color == "azul") {
        eliminarPorId(obj.id);
      }
    } else {
      selecionado.color = "azul";
      selecionado.estado = 1;
      agregarObjeto(selecionado);
    }

    if (isProxy(data.value)) {
      // mainPushData(toRaw(data.value));
      // este es una funcion que existe en front del front
      alertmensaje("Se ha actualizado el horario correctamente");
    }
  };

  const selectClases = (casilla) => {
    var obj = buscarPorId(casilla);
    if (obj != null) {
      if (obj.color == "verde") {
        return "bg-dark";
      } else if (obj.color == "amarillo") {
        return "bg-dark";
      } else if (obj.color == "azul") {
        return "bg-success";
      }
    } else {
      return "";
    }
  };

  const agregarObjeto = (objeto) => {
    var existe = data.value.some((item) => item.id === objeto.id);

    if (!existe) {
      data.value.push(objeto);
      return true; // Éxito
    }

    return false; // El objeto ya existe
  };

  const buscarPorId = (id) => {
    var obj = data.value.find((item) => item.id === id);
    return obj || null;
  };

  const actualizarPorId = (id, nuevoObjeto) => {
    var index = data.value.findIndex((item) => item.id === id);

    if (index !== -1) {
      data[index] = nuevoObjeto;
      return true; // Éxito
    }

    return false; // No se encontró el objeto
  };

  const eliminarPorId = (id) => {
    var index = data.value.findIndex((item) => item.id === id);

    if (index !== -1) {
      data.value.splice(index, 1);
      return true; // Éxito
    }

    return false; // No se encontró el objeto
  };

  const handleSelectChange = () => {
    fechaSiguiente.value = calcularFechasSiguientes(vsemana.value.fecha_inicio);

    postData(props.postBuscarCalendario,
      {
        codigo: vsemana.value.codigo_semestre,
        sala: vsala.value.id,
        semana: vsemana.value.semana,
      }
    ).then((data) => {

      console.log("data", data);
      // usuarios.value = data;
    })
    .catch((error) => {
      console.log("error", error);
    });
  }

  const handleAddHorario = () => {
    console.log("handleAddHorario");
    console.log("data", data.value);
    console.log("vsala", vsala.value);
    console.log("vsemana", vsemana.value);

    postData(props.postStoreCalendario,
      {
        codigo: vsemana.value.codigo_semestre,
        sala: vsala.value.id,
        semana: vsemana.value.semana,
        horarios: data.value,
      }
    ).then((data) => {

      console.log("data", data);
      // usuarios.value = data;
    })
    .catch((error) => {
      console.log("error", error);
    });
  }
</script>
