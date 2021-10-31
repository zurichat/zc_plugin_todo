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
                    <span @click="this.show_newCollab = false;"
                        ><b>Current Collaborators </b></span
                    >
                    <span
                        ><button
                            @click="showAddCollab"
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
                <!-- <div   class="td-w-100 td-flex td-justify-center" v-else-if="!showLoading && selectedTodo.collaborators.length == 0">
                    <small v-if="!show_newCollab"  class="td-text-gray">No collaborator found click on the Add button to add new collaborator</small>
                    </div> -->
                <div>
                    <div v-if="show_newCollab" class="newCollaborators">
                        <newCollab :allMembers="res" :adminPrivilage=admin_previlaged />
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
import { mapActions, mapGetters } from 'vuex';

import axios from 'axios';
import currentCollab from './currentCollaborators.vue';
import newCollab from './new_collaborators.vue';

export default {
  name: 'AssignForm',
  data() {
    return {
      show_newCollab: false,
      showLoading: false,
      admin_previlaged: false,
      allMembers: null,
    };
  },
  components: {
    currentCollab,
    newCollab,
  },
  computed: {
    ...mapGetters({
      selectedTodo: 'todos/selectedTodo',
      isUser: 'todos/user',
      org_member: 'todos/show_organisation_members',
    }),
  },
  methods: {
    ...mapActions({
      getMembers: 'todos/getAllMembers',

    }),
    getAllMembers() {
      axios.get(`https://api.zuri.chat/organizations/${this.isUser.currentWorkspace}/members`)
        .then((res) => {
          this.allMembers = res;
        }).catch((error) => console.log(error));
    },
    checkUserPrevilage() {
      if (this.selectedTodo.user_id == this.isUser[0]._id) {
        this.admin_previlaged = true;
      } else {
        // Check if user is a collaborator admin
        this.selectedTodo.collaborator.forEach((element) => {
          console.log(element);
          if (this.isUser[0]._id == element.collaborator_id) {
            this.admin_previlaged = true;
          } else {
            this.admin_previlaged = false;
          }
        });
      }
    },
    showAddCollab() {
      this.getMembers().then((res) => {
        this.org_member = res;
        console.log(this.org_member);
      });

      if (this.admin_previlaged == false) {
        alert('You dont have previlage');
        this.show_newCollab = false;
      } else {
        this.show_newCollab = true;
      }
    },

    closeAssign() {
      this.$emit('assign');
    },
  },
  mounted() {
    // this.getAllUser();
    // console.log(this.selectedTodo.collaborators)
    this.checkUserPrevilage();
    // console.log(this.admin_previlaged)
  },
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
