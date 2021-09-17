import axios from 'axios'
export default {
    namespaced: true,
    state: {
        todos: [{
            _id: "6142162c9fd1f4f655d44596",
            title: "Didier",
            type: " public ",
            description: "Let my People go!!!",
            labels: [],
            user_id: "6139 a43559842c7444fb01ef ",
            channel: "6142162 c6d - Didier ",
            tasks: [{}, {}, {}],
            colaborators: [],
            created_at: "2021-09-15T15:50:04.448212Z "
        }],
        names: [],
        archive: [],
        trash: [],
        showAll: true,
        isComment: false,
        selectedTodo: null,
        searchedTodo: [],
        errMessage: "No Result Found"
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
        async createTodo({ commit }, data) {
            await axios.post('/create-todo', data)
                .then((response) => commit('ADD_TODOS', response.data.data))
                .catch((error) => {
                    if (error.response) {
                        // The request was made and the server responded with a status code
                        // that falls out of the range of 2xx
                        console.warn(error.response.data);

                    } else if (error.request) {
                        // The request was made but no response was received
                        console.log(error.request);
                    } else {
                        // Something happened in setting up the request that triggered the Error
                        console.log('Error', error.message);
                    }
                    console.log(error.config)
                })
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
        async SEARCH({ commit, dispatch, state }, any) {
            let value = any
            if (value === "") {
                dispatch('TOGGLESHOW', true);
            } else {
                await axios.get(`https://todo.zuri.chat/api/search?key=title&q=${value}`)
                    .then((res) => {
                        console.log(res.data);
                        commit('RESULT', res.data)
                    })
                dispatch('TOGGLESHOW', false);
            }

        },
        TOGGLESHOW({ commit }, any) {
            commit('TOGGLESHOW', any)
        }
    }
}