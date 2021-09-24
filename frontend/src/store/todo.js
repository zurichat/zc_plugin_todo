import axios from 'axios'
export default {
    namespaced: true,
    state: {
        todos: [{ "_id": "614215409fd1f4f655d44594", "channel": "6142153fd6-didier", "colaborators": [], "created_at": "2021-09-15T15:46:07.879110Z", "description": "Let my People go!!!", "labels": [], "tasks": [{ "created_at": "2021-09-21 14:55:00", "recurring": "", "status": 1, "task_id": "6149f244b1939", "title": "This is the first task" }, { "created_at": "2021-09-21 14:55:00", "recurring": "", "status": 1, "task_id": "6149f244b1987", "title": "This is the second task" }], "title": "didier", "type": "public", "user_id": "6139a43559842c7444fb01ef" }, { "_id": "614215409fd1f4f655d44595", "channel": "6142153fdb-didier", "colaborators": [], "created_at": "2021-09-15T15:46:07.900895Z", "description": "Let my People go!!!", "labels": [], "tasks": [], "title": "didier", "type": "public", "user_id": "6139a43559842c7444fb01ef" }, { "_id": "6142162c9fd1f4f655d44596", "channel": "6142162c6d-Didier", "colaborators": [], "created_at": "2021-09-15T15:50:04.448212Z", "description": "Let my People go!!!", "labels": [], "tasks": [], "title": "Didier", "type": "public", "user_id": "6139a43559842c7444fb01ef" }, { "_id": "6149aa45e4b2aebf8ec8d0c7", "channel": "6149aa459a-didier", "colaborators": [], "created_at": "2021-09-21T09:47:49.631284Z", "description": "Typically replies within a minute", "labels": [], "tasks": [], "title": "didier", "type": "public", "user_id": "6139a43559842c7444fb01ef" }],
        names: [],
        archive: [],
        trash: [],
        showAll: true,
        isComment: false,
        selectedTodo: null,
        isAssign: false,
        searchedTodo: [],
        errMessage: "No Result Found"
    },
    mutations: {
        ADD_TODOS(state, data) {
            state.todos.unshift(data)
        },
        TOG_ASSIGN(state) {
            state.isAssign = !state.isAssign
        },
        SET_ARCHIVED(state, data) {
            state.archive = [...data]
        },
        ADD_ARCHIVE(state, data) {
            state.archive.push(data)
        },
        SET_TODOS(state, data) {
            state.todos = data
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
        isAssign(state) {
            return state.isAssign
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
            await axios.get('https://todo.zuri.chat/api/v1/all-todo')
                .then(response => (commit('SET_TODOS', response.data.data)))
                .catch(error => console.log(error))
        },
        toggleAssign({ commit }) {
            console.log('heloo')
            commit('TOG_ASSIGN');

        },
        async getAllArchivedTodos({ commit }) {
            await axios.get('get-archived')
                .then(response => (commit('SET_ARCHIVED', response.data.data)))
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
            let location = state.todos.findIndex(todo => todo._id.toLowerCase() === (any.toLowerCase()));

            commit('ADD_TRASH', state.todos[location])
            return state.todos.splice(location, 1);
        },
        FIND_TODO({ state }, any) {
            let location = state.todos.findIndex(todo => todo.card_id.toLowerCase() === (any.toLowerCase()));
            //let location = state.todos.findIndex(todo => todo.card_id.toLowerCase() === (id.toLowerCase()));
            // console.log(location)
            return location
        },
        ADD_ARCHIVE({ commit, state }, any) {
            let location = state.todos.findIndex(todo => todo.card_id.toLowerCase() === (any.toLowerCase()));

            commit('ADD_ARCHIVE', state.todos[location])
            return state.todos.splice(location, 1);
            //return commit('ADD_ARCHIVE', state.todos.location)
        },
        async SEARCH({ commit, dispatch }, any) {
            let value = any
<<<<<<< HEAD:resources/js/store/todo.js
            if (value === "") {
                dispatch('TOGGLESHOW', true);
            } else {
=======
            if (value != "") {
>>>>>>> f2362dccbdcd57d4cba59e4cb8e0f81e00e67a6c:frontend/src/store/todo.js
                await axios.get(`https://todo.zuri.chat/api/v1/search?key=title&q=${value}`)
                    .then((res) => {
                        console.log(res.data);
                        commit('RESULT', res.data)
                    })
                dispatch('TOGGLESHOW', false);
            } else {
                dispatch('TOGGLESHOW', true)
            }

        },
        TOGGLESHOW({ commit }, any) {
            commit('TOGGLESHOW', any)
        }
    }
}