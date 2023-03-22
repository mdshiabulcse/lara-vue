import { createRouter, createWebHistory } from 'vue-router';
import Index from "../views/pages/index.vue";
import {UserLogin, UserRegister} from "@/views/auth/index.js";
const routes = [
    { path: '/', name:'index', component: Index ,meta:{title:'Home'}},
    { path: '/auth/login', name:'user.login', component: UserLogin ,meta:{title:'User Login'}},
    { path: '/auth/register', name:'user.register',component: UserRegister ,meta:{title:'User Register'}},
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
})
const DEFAULT_TITLE =404;
router.beforeEach((to, from, next) => {
    document.title=to.meta.title || DEFAULT_TITLE;
    next();
})
export default router;