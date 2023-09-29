import './bootstrap';

import { createApp } from 'vue';
// import { createApp } from 'vue/dist/vue.esm-bundler.js';
import HelloWorld from '@/components/HelloWorld.vue';
import Calendario from '@/components/Calendario.vue';
import CalendarioUser from '@/components/CalendarioUser.vue';
import CalendarioComparte from '@/components/CalendarioComparte.vue';
// import Calendario from '@/components/Calendario.vue'

createApp({
    setup() {
        return {
            message: 'Welcome to Your Vue.js App',
        };
    },
    components: {
      'hello': HelloWorld,
      'calendario': Calendario,
      'calendariouser': CalendarioUser,
      'calendariocomparte': CalendarioComparte
    },
}).mount('#app');
