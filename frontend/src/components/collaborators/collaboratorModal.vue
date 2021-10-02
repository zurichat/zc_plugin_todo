<template>
    <div class="overlay">
        <div class="td-bg-white list_container td-p-5 td-rounded ">
            <!-- style="box-shadow: 0 5px 5px -5px #333;" -->
            <div class="td-pb-5">
                <div class="td-flex td-justify-between td-items-center">
                    <h5 class="td-font-bold  td-mb-2 td-cursor-default">
                        Assign Collaborator
                    </h5>
                    <div class=" td-p-2 td-cursor-pointer">
                        <i class="pi pi-times" @click="closeAssign"></i>
                    </div>
                </div>
                <small class="td-text-gray-400"
                    >Assign new collaborators for this task. You can also remove
                    those that are no longer needed</small
                >
                <br />
                <!-- NAV MENU -->
                <div class="td-flex td-justify-between td-items-center td-pt-5">
                    <span @click="show_newCollab = false"
                        ><b>Current Collaborators </b></span
                    >
                    <span
                        ><button
                            @click="selectUser"
                            class="td-border-solid td-border-2 td-p-1"
                        >
                            <i class="pi pi-plus"></i> Add a new collaborator
                        </button>
                    </span>
                </div>
            </div>
            <div>
                
                <div
                    v-if="showLoading"
                    class="td-w-100 td-flex td-justify-center"
                >
                    <i
                        class="pi pi-spin pi-spinner"
                        style="font-size: 2rem"
                    ></i>
                </div>
                <div   class="td-w-100 td-flex td-justify-center" v-else-if="!showLoading && selectedTodo.collaborators.length == 0">
                    <small v-if="!show_newCollab"  class="td-text-gray">No collaborator found click on the Add button to add new collaborator</small>
                    </div>
                <div>
                    <div v-if="show_newCollab" class="newCollaborators">
                        <newCollab :allUsers=organisation_members />
                    </div>

                    <div class="currentCollaborators">
                        <currentCollab />
                    </div>
                </div>
            </div>
            <!-- MODAL FOOTER -->
            <div class="td-pt-5 td-w-100 td-grid td-justify-items-end">
                <button
                    class="td-text-white td-h-6 td-w-100 td-p-5 td-bg-green-500 td-flex td-items-center td-justify-center"
                >
                    Confirm
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
import axios from "axios";
import currentCollab from "./currentCollaborators.vue";
import newCollab from "./new_collaborators.vue";
export default {
    name: "AssignForm",
    data() {
        return {
            show_newCollab: false,
            organisation_members: null,
            showLoading: false
        };
    },
    components: {
        currentCollab,
        newCollab
    },
    computed: {
        ...mapGetters({
            selectedTodo: "todos/selectedTodo"
        })
    },
    methods: {
        selectUser() {
            this.show_newCollab = true;
        },
        getAllUser() {
            this.showLoading = true;
            axios
                .get(
                    `https://api.zuri.chat/organizations/${this.selectedTodo.organisation_id}/members`
                )
                .then(response => {
                    this.showLoading = false;
                    this.organisation_members = response.data.data;
                })
                .catch(error => {
                    this.showLoading = false;
                    console.log(error);
                });
        },
        closeAssign() {
            this.$emit("toggleAssignModal");
        }
    },
    mounted() {
        this.getAllUser();
        console.log(this.selectedTodo.collaborators)
    }
};
</script>
<style scoped>
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
</style>
