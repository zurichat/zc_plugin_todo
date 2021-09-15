export default {
    namespaced: true,
    state: {
        user: {
            id: "1",
            uuid: "05095b1c-06f3-4e61-853a-7e310422a3a8",
            fullname: "Admin",
            email: "testadmin3 @gmail.com ",
            phone: "+2347018995065",
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