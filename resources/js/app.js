import './bootstrap';
import { createApp } from 'vue';
// import { createApp } from 'vue/dist/vue.esm-bundler.js';
import HelloWorld from '@/components/example/HelloWorld.vue';
import CalendarioComparte from '@/components/CalendarioComparte.vue';
import SalaView from '@/components/SalaView.vue';
import AppSalaView from '@/components/app/AppSalaView.vue';
import BuscarUsuario from '@/components/app/BuscarUsuario.vue';
import CalendarioView from '@/components/calendario/CalendarioView.vue';
// import Calendariomain from '@/components/Calendariomain.vue';
// import CalendarioUser from '@/components/CalendarioUser.vue';
// import CalendarioComparte from '@/components/CalendarioComparte.vue';
// import Calendario from '@/components/Calendario.vue'

createApp({
    setup() {
        return {
            message: 'Welcome to Your Vue.js App',
        };
    },
    components: {
      'calendariocomparte': CalendarioComparte,
      'hello-world': HelloWorld,
      'buscar-usuario': BuscarUsuario,
      'sala-view': SalaView,
      'app-sala-view': AppSalaView,
      'calendario-view': CalendarioView,
    },
}).mount('#app');
