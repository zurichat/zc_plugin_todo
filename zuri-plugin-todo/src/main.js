import { h, createApp } from 'vue';
import singleSpaVue from 'single-spa-vue';
import router from './router';
import store from './store';
import App from './App.vue';

const vueLifecycles = singleSpaVue({
    createApp,
    appOptions: {
        render() {
            return h(App, {});
        },
    },
    handleInstance: (app) => {
        app.use(router).use(store);
    },
});

export const { bootstrap } = vueLifecycles;
export const { mount } = vueLifecycles;
export const { unmount } = vueLifecycles;