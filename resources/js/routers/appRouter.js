// Router
import { createWebHistory, createRouter } from "vue-router";

//We created all the routes that the app instance is going to use

const routes = [

    {
        path: '/home',
        name: 'home',
        component: () => import('../components/app/Home.vue'),
        props: true
    },

    {
        path: '/add',
        name: 'addImage',
        component: () => import('../components/app/Add.vue'),
        props: true
    },

  
    
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;