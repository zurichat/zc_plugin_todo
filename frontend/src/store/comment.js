import axios from 'axios';

export default {
    namespaced: true,

    state: {
        comments: [],
        currentTask: {
            title: "Make HNGi8 stage 10",
            task_id: "old"
        }
    },

    getters: {
        getTaskComments: state => {
            return state.comments.filter(comment => {
                return comment.task_id === state.currentTask.task_id;
            })
        },

        getTaskCommentsCount: (state, getters) => {
            return getters.getTaskComments().length;
        },

        getTaskLastComment: (state, getters) => {
            return getters.getTaskComments()[0].created_at;
        },

        getCurrentTask: state => state.currentTask

    },

    mutations: {
        GET_COMMENTS: (state, comments) => {
            state.comments = comments;
        },

        ADD_COMMENT: (state, comment) => {
            state.comments.push(comment);
        },

        UPDATE_CURRENT_TASK: (state, task) => {
            state.currentTask = task;
        }
    },

    actions: {
        updateCurrentTask({ commit }, task) {
            commit("UPDATE_CURRENT_TASK", task)
        },

        async fetchTodoComments({ commit }, { todo_id, user_id, org_id }) {
            try {
                const response = await axios.get(`https://todo.zuri.chat/api/v1/todo-comment/${todo_id}?user_id=${user_id}&organisation_id=${org_id}`);
                const comments = response.data.data.data;
                commit('GET_COMMENTS', comments);
                console.log('new commnets is here', comments)
                return comments;
            } catch (error) {
                console.log('error fetching tasks', error);
            }
        },

        async saveComment(_, { todo_id, user_id, org_id, task_id, body }) {
            try {
                const response = await axios.post(`https://todo.zuri.chat/api/v1/add-comment/${todo_id}?user_id=${user_id}&organisation_id=${org_id}`, {
                    body,
                    task_id,
                    user_id
                });
                console.log("save comment", response.data);
                return response.data;

            } catch (err) {
                console.log('error updating task', err);
            }
        },

        newComment({ commit }, comment) {
            commit("ADD_COMMENT", comment)
        }
    }
}