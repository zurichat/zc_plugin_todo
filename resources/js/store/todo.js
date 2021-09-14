import axios from 'axios'
export default {
    namespaced: true,
    state: {
        todos: [],
        names: [],
        archive: [],
        trash: [],
        showAll: true,
        isComment: false,
        selectedTodo: null,
        searchedTodo: []

    },
    mutations: {
        ADD_TODOS(state, data) {
            state.todos.push(data)
        },
        ADD_ARCHIVE(state, data) {
            state.archive.push(data)
        },
        ADD_TRASH(state, data) {
            state.trash.push(data)
        },
        SELECTED_TODO(state, data) {
            state.selectedTodo = data
        },
        RESULT(state, data) {
            state.searchedTodo = data
        },
        TOGGLESHOW(state, data) {
            state.showAll = data
        }
    },
    getters: {
        allTodos(state) {
            return state.todos
        },
        allArchive(state) {
            return state.archive
        },
        allTrash(state) {
            return state.trash
        },
        searchedTodo(state) {
            return state.searchedTodo
        },
        showAll(state) {
            return state.showAll
        }
    },
    actions: {
        async getAllTodos({ commit }) {
            await axios.get('https://todo.zuri.chat/api/get-tasks')
                .then(response => (commit('ADD_TODOS', response.data.data)))
                .catch(error => console.log(error))
        },
        createTask({ commit }, data) {
            return commit('ADD_TODOS', data)
                // await axios.post('/https://todo.zuri.chat/api/add_task', data)
                //     .then((response) => { return commit('ALL_NAMES', response.data.data) })
                //     .catch((error) => { return (error) })
        },
        ADD_TRASH({ commit, state }, any) {
            let location = state.todos.findIndex(todo => todo.card_id.toLowerCase() === (any.toLowerCase()));

            commit('ADD_TRASH', state.todos[location])
            return state.todos.splice(location, 1);
        },
        FIND_TODO({ state }, any) {
            let location = state.todos.findIndex(todo => todo.card_id.toLowerCase() === (any.toLowerCase()));
            //let location = state.todos.findIndex(todo => todo.card_id.toLowerCase() === (id.toLowerCase()));
            // console.log(location)
            return location
        },
        ADD_ARCHIVE({ commit, dispatch, state }, any) {
            let location = state.todos.findIndex(todo => todo.card_id.toLowerCase() === (any.toLowerCase()));

            commit('ADD_ARCHIVE', state.todos[location])
            return state.todos.splice(location, 1);
            //return commit('ADD_ARCHIVE', state.todos.location)
        },
        SEARCH({ commit, dispatch, state }, any) {
            let value = any
            if (value === "") {
                dispatch('TOGGLESHOW', true);
            } else {
                let result = state.todos.filter(todo => todo.title.toLowerCase().indexOf(value.toLowerCase()) >= 0)
                dispatch('TOGGLESHOW', false);
                commit('RESULT', result)
            }

        },
        TOGGLESHOW({ commit }, any) {
            commit('TOGGLESHOW', any)
        }
    }
}