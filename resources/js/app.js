import './bootstrap';

import 'flowbite';

import { createRouter, createWebHistory } from 'vue-router';
import { createApp } from 'vue';

// import { createApp } from 'vue/dist/vue.esm-bundler.js';
import Error from '@/components/example/Error.vue';
import Welcome from '@/components/example/Welcome.vue';
// import CalendarioComparte from '@/components/CalendarioComparte.vue';
// import SalaView from '@/components/SalaView.vue';
// import AppSalaView from '@/components/app/AppSalaView.vue';
// import BuscarUsuario from '@/components/app/BuscarUsuario.vue';
// import CalendarioView from '@/components/calendario/CalendarioView.vue';
// import Calendariomain from '@/components/Calendariomain.vue';
// import CalendarioUser from '@/components/CalendarioUser.vue';
// import CalendarioComparte from '@/components/CalendarioComparte.vue';
// import Calendario from '@/components/Calendario.vue'

const routes = [
  // { path: '/', component: HelloWorld, name: 'inicio' },
  { path: '/error', component: Error, name: 'error' },
  { path: '/Welcome', component: Welcome, name: 'Welcome' },
]

const router = createRouter({
  history: createWebHistory(),
  // history: VueRouter.createWebHashHistory(),
  routes,
})

const app = createApp({
    setup() {
        return {
            message: 'Welcome to Your Vue.js App',
        };
    },
    components: {
      // 'calendariocomparte': CalendarioComparte,
      'error': Error,
      // 'buscar-usuario': BuscarUsuario,
      // 'sala-view': SalaView,
      // 'app-sala-view': AppSalaView,
      // 'calendario-view': CalendarioView,
    },
});

app.use(router);
app.mount('#app');
