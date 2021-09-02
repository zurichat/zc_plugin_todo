// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */

require('./bootstrap');

import router from './router';
import store from './store'
import { createApp } from 'vue'
import App from './App.vue'
const app = createApp(App);
app.use(router)
    .use(store)
    .mount("#app")