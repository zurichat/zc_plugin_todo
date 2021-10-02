import { getAllTodos, createTodo } from '../plugins/xhr';
import axios from 'axios';
import Centrifuge from 'centrifuge'
export default {
    namespaced: true,
    state: {
        isUser:{
                Organizations: [
                    "61516d0f9d521e488c5971f6"
                ],
                _id: "61516cd39d521e488c5971f3",
                created_at: "2021-09-27T09:03:47.019895424+02:00",
                deactivated: false,
                deactivated_at: "0001-01-01T00:00:00Z",
                email: "posimichael6@gmail.com",
                email_verification: null,
                first_name: "Tolulope",
                isverified: true,
                last_name: "Makinde ",
                password: "$2a$14$f8knCG8DezbTeMJAQHYEmOJvr3j7Fr7.0K8RKtE9d3Y6sxoRaRfke",
                password_resets: null,
                phone: "",
                role: "",
                settings: null,
                social: false,
                time_zone: "",
                updated_at: "0001-01-01T00:00:00Z",
                workspaces: null
        },
        todos: [],
        names: [],
        archive: [],
        centrifuge: null,
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
            console.log('hey')
            if (Array.isArray(data) === true) state.todos = data
            else state.todos.unshift(data)
            console.log(state)
        },
        CN_CTR(state) {
            state.centrifuge = new Centrifuge('wss://realtime.zuri.chat/connection/websocket', { debug: true });
        },
        IS_USER(state, data) {
            state.isUser = data
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
        selectedTodo(state){
            return state.selectedTodo
        },
        allArchive(state) {
            return state.archive
        },
        centrifuge(state) {
            return state.centrifuge
        },
        user(state) {
            return state.isUser
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
        },
        organization(state) {
            return state.isUser.Organizations[0];
        }
    },
    actions: {
        async HandleGetTodos({ commit, state }) {
            console.log(state)
            const user_id = state.isUser["0"]._id;
            const org_id = state.isUser["0"].org_id;
            try {
                const response = await getAllTodos(user_id, org_id);
                console.log('me')
                commit('ADD_TODOS', response.data.data);
            } catch (error) {
                console.log(`Error from handleGetTodos ${error}`);
            }

        },
        toggleAssign({ commit }) {
            commit('TOG_ASSIGN');
        },
        selectedTodo({commit}, todo_data){
            commit('SELECTED_TODO', todo_data)
        },
        CONNECT_CENTRIFUGE({ commit }) {
            commit('CN_CTR')
        },
        ADD_USER({ commit }, data) {
            commit('IS_USER', data)
        },
        async getAllArchivedTodos({ commit, state }) {
            const user_id = state.isUser._id;
            const org_id = state.isUser.Organizations[0];
            await axios.get(`get-archived?user_id=${user_id}&organisation_id=${org_id}`)
                .then(response => (commit('SET_ARCHIVED', response.data.data)))
                .catch(error => console.log(error))
        },
        async HandleCreateTodo({ state }, any) {
            // const user_id = state.isUser["0"]._id;
            const org_id = state.isUser["0"].org_id;
            try {
                const response = await createTodo(org_id, any);
                console.log('todo created sucesfully', response)
                    // commit('ADD_TODOS', data);
            } catch (error) {
                console.log(`Error from handleGetTodos ${error}`);
            }

        },
        centrifugeAddTodo({ commit }, data) {
            commit('ADD_TODOS', data)
        },
       async ADD_TRASH({ state }, any) {
            let location = state.todos.findIndex(todo => todo._id.toLowerCase() === (any.toLowerCase()));
            // commit('ADD_TRASH', state.todos[location])
                                                                    
            // FUNCTION TO DELETE TODO FROM DATABASE
            await axios.delete(`https://todo.zuri.chat/api/v1/todo/${any.toLowerCase()}/delete?organisation_id=614679ee1a5607b13c00bcb7`)
            // .then(response => (commit('SET_ARCHIVED', response.data.data)))
            .then((response)=>{
                console.log(response);
            })
            .catch(error => console.log(error))

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
            if (value != "") {
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