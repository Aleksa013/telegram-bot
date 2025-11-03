import { createRouter, createWebHistory } from "vue-router";
import Home from "@/Pages/Home.vue";
import Menu from "@/Pages/Menu.vue";

const routes = [
    { path: "/", component: Home },
    { path: "/menu", component: Menu },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
