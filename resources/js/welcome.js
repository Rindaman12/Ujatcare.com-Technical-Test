require('./bootstrap');

//Similar functionality as the app.js, please see that file for a more detailed explanation

import { createApp, defineAsyncComponent } from 'vue';
import { Quasar } from 'quasar'
import router from './routers/welcomeRouter.js';
import vueRecaptcha from 'vue3-recaptcha2';


import WelcomeLayout from './components/welcome/WelcomeLayout.vue'


createApp({
    components : {
        // app
        'welcome-layout': WelcomeLayout,
    },
})  
    .component('recaptcha', vueRecaptcha)
    .use(router)
    .use(Quasar)
    .mount("#welcome")
