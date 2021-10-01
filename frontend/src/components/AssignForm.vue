<template>
    <div class="overlay">
        <div
            class="td-bg-white list_container td-p-2 td-rounded td-pt-10 td-px-10 td-pb-8"
        >
            <div class="td-flex td-justify-between td-items-center">
                <h5 class="td-font-bold  td-mb-2 td-cursor-default">Assign Collaborator</h5>
                <div @click="assign()" class=" td-p-2 td-cursor-pointer" >
                    <i class="pi pi-times" @click="closeAssign"></i>
                </div>
            </div>
            <input
                @input="search()"
                v-model="value"
                class="td-rounded td-my-3 td-w-full td-border td-py-2 td-px-2 hover:td-border-green-500 td-outline-none"
                type="text"
            />
            <div class="box">
                <!-- <div class="input-box"></div> -->
                <div v-if="showLoading" class="td-w-100 td-flex td-justify-center">
<i class="pi pi-spin pi-spinner" style="font-size: 2rem"></i>
</div>
                <div>
                    <div
                       
                        v-for="(user, index) in users"
                        :key="index"
                        class="td-border-solid td-border-2 td-flex  hover:td-border hover:td-shadow td-border-b td-p-2 td-my-2 td-pb-2 "
                    >
                        <img v-if="user.image_url != ''"
                            class="td-self-center td-w-9 td-h-9 td-rounded "
                            :src="user.image_url"
                        />
                        <img v-else src="https://picsum.photos/200/300" class="td-self-center td-min-w-min td-h-9 td-rounded "/>
                        <div class="td-px-2 td-pl-3 w-100 td-self-stretch " style=" width:100%">
                            User name
                              {{user.display_name.slice(0, 20)}}
                            <div class="td-text-gray-400">
                                {{user.email.slice(0, 20) }}
                            </div>
                        </div>
                     
                            <!-- @click="assign()"  -->
                            <div >
                            <button @click="add_collaborator(user._id)"  class="td-text-9/1 td-shadow-lg td-text-white td-bg-green-500 td-rounded-full td-h-14 td-w-14 td-flex td-items-center td-justify-center">+</button>
                            </div>
                       
                    </div>
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
            value: "",
            showLoading:false,
            org_id:'614679ee1a5607b13c00bcb7'
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
            this.showLoading = true
            axios
            .get(`https://api.zuri.chat/organizations/${this.org_id}/members`).then((response)=>{
                this.showLoading = false
                this.users = response.data.data
            }).catch((error)=>{
                this.showLoading = false
                console.log(error)
            })
                // .get("https://randomuser.me/api/?results=15")
                // .then(response => (this.users = response.data.results));
        },
        add_collaborator(user_id, todo_id){
            axios.put(`https://todo.zuri.chat/api/v1/assign-collaborators/${todo_id}?organisation_id=${this.org_id}`, {user_id:user_id}).then((request)=>{
                console.log(request)
            }).catch((error)=>{
                console.log(error)
            })
        },
        closeAssign() {
            this.$emit("toggleAssignModal");
        },
        search() {
            let value;
            if (this.value != "") {
                value = this.users.filter(
                    user =>
                        user.email
                            .toLowerCase()
                            .indexOf(this.value.toLowerCase()) >= 0
                );
                
            } else {
                this.getUser()
                // value = this.users;
              
                // this.users = value;
                // alert(value)
            }
                console.log(value)
            
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
    max-width: 25em;
}
.box {
    overflow-y: scroll;
    max-height: 20em;
}
</style>
