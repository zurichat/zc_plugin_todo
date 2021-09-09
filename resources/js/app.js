require('./bootstrap');
import 'primevue/resources/primevue.min.css'; //corecss
import 'primeicons/primeicons.css';
import router from './router';
import store from './store'
import VueClickAway from "vue3-click-away";
import { createApp } from 'vue'
import { Vue3Mq } from "vue3-mq";
import App from './App.vue'
const app = createApp(App);
app.use(Vue3Mq, {
        breakpoints: {
            xs: 0,
            sm: 576,
            md: 768,
            lg: 992,
            xl: 1200,
            xxl: 1400
        },
    }).use(router)
    .use(VueClickAway)
    .use(store)
    .mount("#app")