<template>
    <div class="overlay">
        <div class="td-bg-white list_container td-p-2 td-rounded ">
            <div class="td-flex td-justify-between td-items-center">
                <h3 class="td-font-bold text-lg mb-2">Assign Collaborator</h3>
                <div @click="assign()" class="td-cursor-default td-p-2">
                    <i class="pi pi-times"></i>
                </div>
            </div>
            <div class="box">
                <div class="input-box"></div>
                <input
                    @input="search()"
                    v-model="value"
                    class="td-rounded td-w-full td-border td-py-2 td-px-2 hover:td-border-green-500 td-outline-none"
                    type="text"
                />

                <div>
                    <label
                        @click="assign()"
                        :for="user.name.first"
                        v-for="(user, index) in users"
                        :key="index"
                        class="td-flex hover:td-border hover:td-shadow td-border-b td-p-2 td-my-2 td-pb-2 td-items-center"
                    >
                        <span class="td-px-2 tracking-wide">{{
                            user.name.first + " " + user.name.last
                        }}</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
// // import Checkbox from 'primevue/checkbox'
import { mapActions } from "vuex";
import axios from "axios";
export default {
    name: "AssignForm",
    data() {
        return {
            checked: [],
            users: [],
            value: ""
        };
    },
    components: {
        // Checkbox
    },
    methods: {
        ...mapActions({
            tog_assign: "todos/toggleAssign"
        }),
        assign() {
            this.tog_assign();
        },
        getUser() {
            axios
                .get("https://randomuser.me/api/?results=15")
                .then(response => (this.users = response.data.results));
        },
        search() {
            let value;
            if (this.value != "") {
                value = this.users.filter(
                    user =>
                        user.name.first
                            .toLowerCase()
                            .indexOf(this.value.toLowerCase()) >= 0
                );
            } else {
                value = this.users;
            }
            this.users = value;
        }
    },
    mounted() {
        this.getUser();
    }
};
</script>
<style>
.overlay {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 2;
    background: rgba(0, 0, 0, 0.14901960784313725);
}
.list_container {
    width: 100%;
    max-width: 30em;
}
.box {
    overflow-y: scroll;
    max-height: 20em;
}
</style>
