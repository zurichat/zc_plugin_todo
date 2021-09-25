import axios from 'axios';

export default {
    namespaced: true,

    state: {
        todo: {},
        comments: [],
    },

    getters: {
        getTasks: state => state.todo.tasks || [],

        getComments: state => state.comments,

        getTaskTitle: state => state.todo.description
    },

    mutations: {

        ADD_TODO: (state, todo) => {
            state.todo = todo;
        },

        UPDATE_TASK_STATUS: (state, task_id, status) => {

            state.todo.tasks.map(task =>
                task._id === task_id ? task.status = status : task
            )
        }
    },

    actions: {
        async fetchTodoTasks({ commit }, { todo_id, user_id, org_id }) {
            try {
                const response = await axios.get(`https://todo.zuri.chat/api/v1/todo/${todo_id}/${user_id}/show/?organisation_id=${org_id}`);
                const todo = response.data;
                commit('ADD_TODO', todo);
                return todo;
            } catch (error) {
                console.log('error fetching tasks', error);
            }
        },

        async updateTaskStatus({ commit }, { task_id, status }) {
            try {
                await axios.put(`https://todo.zuri.chat/api/v1/${task_id}`);

                commit('UPDATE_TASK_STATUS', task_id, status)
            } catch (err) {
                console.log('error updating task', err);
            }
        }
    }
}