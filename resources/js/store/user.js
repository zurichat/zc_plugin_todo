export default {
    namespaced: true,
    state: {
        user: {
            id: "1",
            uuid: "6139a43559842c7444fb01ef",
            fullname: "Admin",
            email: "testadmin3@gmail.com ",
            phone: "+234701234567",
            verified_at: null
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