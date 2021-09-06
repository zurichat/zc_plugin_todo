export default {
    namespaced: true,
    state: {
        user: {
            fullname: 'Didier',
            userId: "05095b1c-06f3-4e61-853a-7e310422a3a8"
        }
    },
    mutations: {

    },
    getters: {
        user(state) {
            return state.user
        }

    },
    actions: {

    }
}