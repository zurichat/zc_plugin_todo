import { createStore } from 'vuex';

import todos from './todo';
import comment from './comment';
// import user from './user';
const store = createStore({
    state: {

    },
    mutations: {

    },
    actions: {

    },
    modules: {
        todos,
        comment
        // user
    }
})

export default store