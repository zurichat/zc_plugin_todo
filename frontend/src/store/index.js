import { createStore } from 'vuex';

import todos from './todo';
import user from './user';
import task from './task';
export default createStore({
    state: {

    },
    mutations: {

    },
    actions: {

    },
    modules: {
        todos,
        user,
        task
    }
})