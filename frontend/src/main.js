import { h, createApp } from 'vue';
import singleSpaVue from 'single-spa-vue';
// import auth from "plugins/auth";
// import { GetUserInfo } from "@zuri/control";
import 'primevue/resources/primevue.min.css'; // corecss
import 'primeicons/primeicons.css';
import 'primevue/resources/themes/saga-green/theme.css';
import axios from 'axios';
import router from './router';
import store from './store';
import './assets/styles/app.css';
import VueClickAway from 'vue3-click-away';
import App from './App.vue';
import 'vue3-circle-progress/dist/circle-progress.css';

axios.defaults.baseURL = 'https://todo.zuri.chat/api/v1';
// import './set-public-path'
// Vue.config.productionTip = false;
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
    app.use(VueClickAway);
    app.use(store);
  },
});

export const { bootstrap } = vueLifecycles;
export const { mount } = vueLifecycles;
export const { unmount } = vueLifecycles;
