import axios from 'axios';
import { comment } from 'postcss';

export default {
    namespaced: true,

    state: {
        comments: [],
    },

    getters: {
        getTaskComments: state => task_id => {
            return state.comments.filter(comment => {
                return comment.task_id === task_id;
            })
        },

        getTaskCommentsCount: (state, getters) => task_id => {
            return getters.getTaskComments(task_id).length;
        },

        getTaskLastComment: (state, getters) => task_id => {
            return getters.getTaskComments(task_id)[0].created_at;
        },

    },

    mutations: {
        GET_COMMENTS: (state, comments) => {
            state.comments = comments;
        },

        ADD_COMMENT: (state, comment) => {
            state.comments.push(comment);
        }
    },

    actions: {
        async fetchTodoComments({ commit }, { todo_id, user_id, org_id }) {
            try {
                const response = await axios.get(`https://todo.zuri.chat/api/v1/todo-comment/${todo_id}?user_id=${user_id}&organisation_id=${org_id}`);
                const comments = response.data;
                commit('GET_COMMENTS', comments);
                return comments;
            } catch (error) {
                console.log('error fetching tasks', error);
            }
        },

        async saveComment({ commit }, { task_id, status }) {
            try {
                await axios.put(`https://todo.zuri.chat/api/v1/${task_id}`);

                commit('UPDATE_TASK_STATUS', task_id, status)
            } catch (err) {
                console.log('error updating task', err);
            }
        },

        async getComments({ commit }, { task_id }) {
            try {
                const comments = await axios();
                commit('GET_COMMENTS', comments);
            } catch (err) {
                console.log("error fetching task comment", err)
            }
        },

        async addComment({ commit }, { task_id, comment }) {
            try {
                commit('ADD_COMMENT', comment);
                await axios.put(`https://todo.zuri.chat/api/v1/${task_id}`);
            } catch (err) {
                console.log('error commenting', err);
            }
        }
    }
}