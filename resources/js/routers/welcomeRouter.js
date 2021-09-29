// Router
import { createWebHistory, createRouter } from "vue-router";

//Se crean las rutas para ser usadas con los componentes que seran llamados

const routes = [
    {
        path: '/register',
        name: 'register',
        component: () => import('../components/welcome/auth/Register.vue'),
        props: true
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('../components/welcome/auth/Login.vue'),
        props: true
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;