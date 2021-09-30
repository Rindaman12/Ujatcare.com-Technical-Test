// Router
import { createWebHistory, createRouter } from "vue-router";

//We created all the routes that the welcome instance is going to use

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