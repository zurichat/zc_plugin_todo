import { h, createApp } from 'vue';
import singleSpaVue from 'single-spa-vue';
import 'primevue/resources/primevue.min.css'; //corecss
import 'primeicons/primeicons.css';
import 'primevue/resources/themes/saga-green/theme.css';
import router from './router';
import store from './store'
import axios from "axios";
import "./assets/styles/app.css"
axios.defaults.baseURL = 'https://todo.zuri.chat/api/v1'
import VueClickAway from "vue3-click-away";
import App from './App.vue'
// import './set-public-path'

const vueLifecycles = singleSpaVue({
    createApp,
    appOptions: {
        render() {
            return h(App, {
                // single-spa props are available on the "this" object. Forward them to your component as needed.
                // https://single-spa.js.org/docs/building-applications#lifecyle-props
                // if you uncomment these, remember to add matching prop definitions for them in your App.vue file.
                /*
                name: this.name,
                mountParcel: this.mountParcel,
                singleSpa: this.singleSpa,
                */
            });
        },
    },
    handleInstance(app) {
        app.use(router);
        app.use(VueClickAway)
        app.use(store);

    },
});

export const bootstrap = vueLifecycles.bootstrap;
export const mount = vueLifecycles.mount;
export const unmount = vueLifecycles.unmount;