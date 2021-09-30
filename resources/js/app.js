require('./bootstrap');

// We create the vue elements

import { createApp, defineAsyncComponent } from 'vue';
import { Quasar } from 'quasar'
import router from './routers/appRouter.js';

// We import the layout component

import AppLayout from './components/app/AppLayout.vue'

//We create the app instance and we assign the components and plugins

createApp({
    components : {
        // app
        'app-layout': AppLayout,
    },
})  
    .use(router)
    .use(Quasar)
    .mount("#app")