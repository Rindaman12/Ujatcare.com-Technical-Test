// Router
import { createWebHistory, createRouter } from "vue-router";

//Se crean las rutas para ser usadas con los componentes que seran llamados

const routes = [


    //Inicio

    {
        path: '/home',
        name: 'home',
        component: () => import('../components/app/Home.vue'),
        props: true
    },

  
    
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;