require('./bootstrap');
import 'primevue/resources/primevue.min.css'; //corecss
import 'primeicons/primeicons.css';
import router from './router';
import store from './store'
import { createApp } from 'vue'
import App from './App.vue'
const app = createApp(App);
app.use(router)
    .use(store)
    .mount("#app")