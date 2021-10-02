<template>
    <div>
        <input
            @input="search()"
            v-model="value"
            class="td-rounded td-my-3 td-w-full td-border td-py-2 td-px-2 hover:td-border-green-500 td-outline-none"
            type="text"
        />
        <div
            class="box td-absolute td-bg-white td-w-100"
            v-if="hideSearchResult == false"
        >
            <!-- <div class="input-box"></div> -->
            <div v-if="showLoading" class="td-w-100 td-flex td-justify-center">
                <i class="pi pi-spin pi-spinner" style="font-size: 2rem"></i>
            </div>
            <div class="td-grid td-grid-cols-1">
                <div v-for="(user, index) in searchValue" :key="index" class="">
                    <div class="td-flex td-justify-between td-px-4">
                    <span class="td-w-100 td-py-1">{{ user.user_name.slice(0,30) }}</span>
                    <span class=" td-text-green-500 " @click="add_collaborator(user._id)">Add</span>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import Checkbox from 'primevue/checkbox'
import { mapActions } from "vuex";
import { mapGetters } from "vuex";
import axios from "axios";

export default {
    name: "NewCollab",
    data() {
        return {
            checked: [],
            users: [],
            value: "",
            searchValue: [],
            showLoading: false,
            org_id: "614679ee1a5607b13c00bcb7",
            hideSearchResult: true
        };
    },
    computed: {
        ...mapGetters({
            selectedTodo: "todos/selectedTodo"
        })
    },
    methods: {
        ...mapActions({
            tog_assign: "todos/toggleAssign"
        }),
        assign() {
            this.tog_assign();
        },

        add_collaborator(user_id){
            let data={
                admin_status:'0',
                collaborator_id:'',
                user_id:user_id,
            }
            axios.put(`https://todo.zuri.chat/api/v1/assign-collaborators/${this.selectedTodo._id}?organisation_id=${this.org_id}`, data).then((request)=>{
                console.log(request)
            }).catch((error)=>{
                console.log(error)
            })
        },

        search() {
            let value;
            if (this.value != "") {
                this.hideSearchResult = false;

                value = this.users.filter(
                    user =>
                        user.user_name
                            .toLowerCase()
                            .indexOf(this.value.toLowerCase()) >= 0
                );
            } else {
                this.hideSearchResult = true;
                // this.searchValue = value = this.users;

                value = this.users;

                // this.users = value;
                // alert(value)
            }

            this.searchValue = value;
        }
    },
    props: {
        allUsers: {
            type: Object
        }
    },
    mounted() {
        // this.getUser();
        this.users = this.allUsers;
        console.log(this.allUsers)
    }
};
</script>
<style>
.box {
    overflow-y: scroll;
    max-height: 20em;
    min-width: 20em;
}
</style>
