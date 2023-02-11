import { createApp } from 'vue';
import { createPinia } from 'pinia';
import './style.css';
import './template.js';
import router from "./router/index.js";
import App from './App.vue';

const pinia = createPinia()
const  app=createApp(App)
    app.use(pinia);
    app.use(router);
    app.mount('#app');
