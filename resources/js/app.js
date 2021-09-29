require('./bootstrap');

// Se crean los elementos de Vue

import { createApp, defineAsyncComponent } from 'vue';
import { Quasar } from 'quasar'
import router from './routers/appRouter.js';

// se importan los componentes

import AppLayout from './components/app/AppLayout.vue'

//Se crea la app y se anexan los componentes y plugins

createApp({
    components : {
        // app
        'app-layout': AppLayout,
    },
})  
    .use(router)
    .use(Quasar)
    .mount("#app")