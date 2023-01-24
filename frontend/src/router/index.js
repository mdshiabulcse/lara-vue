import { createRouter, createWebHistory } from 'vue-router';
import Index from "../views/pages/index.vue";


const routes = [
    { path: '/', component: Index },

];
const router = createRouter({
    history: createWebHistory(import.meta.BASE_URL),
    routes,
})
export default router;