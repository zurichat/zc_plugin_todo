<template>
    <div>
        <input
            @input="search()"
            v-model="value"
            class="td-rounded td-my-3 td-w-full td-border td-py-2 td-px-2 hover:td-border-green-500 td-outline-none"
            type="text"
        />
        <div
            class="box td-absolute td-bg-white td-w-100 td-p-2 td-rounded td-shadow td-border"
            v-if="hideSearchResult == false"
        >
            <div v-if="showLoading" class="td-w-100 td-flex td-justify-center">
                <i class="pi pi-spin pi-spinner" style="font-size: 2rem"></i>
            </div>
            <div v-else class="td-grid td-grid-cols-1">
                <div v-for="(user, index) in searchValue" :key="index" class="">
                    <div class="td-flex td-justify-between td-px-4">
                    <span class="td-w-100 td-py-1">{{ user.user_name.slice(0,30) }}</span>

                    <span v-if="selectedTodo.collaborators.collaborator_id != user._id" class=" td-text-green-500 " @click="add_collaborator(isUser[0]._id, user._id, user)">
                        <span v-if="adding == true">
                            Adding.....
                        </span>
                        <span v-else-if="adding == false">
                            Remove
                        </span>
                        <span v-else> Add </span>
                    </span>
                    <span v-else class=" td-text-green-500 ">Remove</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import Checkbox from 'primevue/checkbox'
// import {GetWorkspaceUsers} from 'zuricontrol'
import { mapActions } from 'vuex';
import { mapGetters } from 'vuex';
import axios from 'axios';

export default {
  name: 'NewCollab',
  data() {
    return {
      checked: [],
      users: [],
      value: '',
      searchValue: [],
      showLoading: false,
      hideSearchResult: true,
      userExist: null,
      adding: null,
    };
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
      tog_assign: 'todos/toggleAssign',
      getMembers: 'todos/getAllMembers',

    }),
    assign() {
      this.tog_assign();
    },

    collab_exist(collab_user_id) {
      this.selectedTodo.collaborators.forEach((element) => {
        if (collab_user_id == element.collaborator_id) {
          this.userExist = true;
        } else {
          this.userExist = false;
        }
      });
      return this.userExist;
    },
    getAllMembers() {
      this.showLoading = true;
      axios.get(`https://api.zuri.chat/organizations/${this.isUser.currentWorkspace}/members`)
        .then((response) => {
          // console.log(response)
          this.users = response;
          this.showLoading = false;
          console.log(this.users);
        }).catch((error) => {
          console.log(error);
        });
    },
    add_collaborator(logged_in_user, collaborator_id, user) {
      console.log(user);
      this.adding = true;
      collaborator_id;
      const data = {
        admin_status: '0',
        collaborator_id: user.email,
        user_id: logged_in_user,
        email: user.email,
        name: user.display_name,
      };
      axios.put(`https://todo.zuri.chat/api/v1/assign-collaborators/${this.selectedTodo._id}?organisation_id=${this.selectedTodo.organisation_id}`, data).then((request) => {
        console.log(request);
        if (request.data.status == 'success') {
          alert('Collaborator Added');
        }
        this.adding = false;
      }).catch((error) => {
        console.log(error);
        this.adding = false;
      });
    },

    search() {
      let value;
      if (this.value != '') {
        this.hideSearchResult = false;

        value = this.users.filter(
          (user) => user.user_name
            .toLowerCase()
            .indexOf(this.value.toLowerCase()) >= 0,
        );
        this.collab_exist(this.users._id);
      } else {
        this.hideSearchResult = true;
        // this.searchValue = value = this.users;

        value = this.users;
        this.collab_exist(this.users._id);

        // this.users = value;
        // alert(value)
      }

      this.searchValue = value;
    },
  },
  props: {
    adminPrivilage: {
      type: Boolean,
    },
  },
  mounted() {
    this.getAllMembers();
    // console.log(this.org_member)
    //    this.users =  this.org_member

    //  console.log(GetWorkspaceUsers())

    // this.getUser();
    // this.users = this.allUsers;
    // console.log(this.isUser)
    // get organisation members
  },
};
</script>
<style>
.box {
    overflow-y: scroll;
    max-height: 20em;
    min-width: 20em;
}
</style>
