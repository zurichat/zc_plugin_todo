import axios from 'axios'
export default {
    namespaced: true,
    state: {
        todos: [],
        names: [],
    },
    mutations: {
        ALL_TODOS(state, data) {
            state.todos.push(data)
        }
    },
    getters: {
        allTodos(state) {
            return state.todos
        },

    },
    actions: {
        async getAllTodos({ commit }) {
            await axios.get('https://todo.zuri.chat/api/get-tasks')
                .then(response => (commit('ALL_TODOS', response.data.data)))
                .catch(error => console.log(error))
        },
        createTask({ commit }, data) {
            return commit('ALL_TODOS', data)
                // await axios.post('/https://todo.zuri.chat/api/add_task', data)
                //     .then((response) => { return commit('ALL_NAMES', response.data.data) })
                //     .catch((error) => { return (error) })
        }
    }
}