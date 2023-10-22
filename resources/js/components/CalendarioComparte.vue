<template>
  <div>
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-sm">
        <thead>
          <tr>
            <th scope=""></th>
            <th scope=""></th>
            <th class="text-center" v-for="(semana, i) in semanas" :key="i">
              <strong>{{ semana }}</strong>
            </th>
          </tr>
          <tr>
            <th scope=""></th>
            <th scope=""></th>
            <th class="text-center" v-for="(semana, k) in semanas" :key="k">
              {{ k }} - 09 - 23
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
</template>

<script setup>
  import { ref, isProxy, toRaw, onMounted } from "vue";

  const props = defineProps({
    editable: Boolean(false),
    horarios: Array,
    myhorario: Array,
    alertmensaje: function () {},
  });

  const semanas = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
  const dias = ["L", "M", "X", "J", "V", "S"];
  const data = ref([]);

  const initializeData = () => {
    console.log("myhorario", props.myhorario);

    if (props.myhorario.length > 0) {
      data.value = props.myhorario;
    } else {
      data.value = [];
    }
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
</script>
