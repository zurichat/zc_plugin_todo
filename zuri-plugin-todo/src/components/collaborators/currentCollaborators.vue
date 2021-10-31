<template>
  <div>
    <div class="box">
      <!-- <div class="input-box"></div> -->
      <div v-if="showLoading" class="td-w-100 td-flex td-justify-center">
        <i class="pi pi-spin pi-spinner" style="font-size: 2rem"></i>
      </div>
      <div>
        <div
          v-for="(user, index) in selectedTodo.collaborators"
          :key="index"
          class="
            td-border-solid td-border-2 td-flex
            hover:td-border hover:td-shadow
            td-border-b td-p-2 td-my-2 td-pb-2
          "
        >
          <!-- <img v-if="user.image_url != ''"
                            class="td-self-center td-w-9 td-h-9 td-rounded "
                            :src="user.image_url"
                        /> -->
          <img
            src="https://picsum.photos/200/300"
            class="td-self-center td-w-9 td-h-9 td-rounded"
          />
          <div
            class="td-px-2 td-pl-3 w-100 td-self-stretch"
            style="width: 100%"
          >
            {{ user.collaborator_id }}
            <!-- {{ user.name.first.slice(0, 20) }} -->
            <div class="td-text-gray-400">
              tjfaithpro@gmail.com
              <!-- {{user.email.slice(0, 20) }} -->
            </div>
          </div>
          <!-- @click="assign()"  -->
          <div
            class="
              td-flex
              td-justify-around
              td-justify-items-center
              td-text-green-500
            "
            style="width: 100%"
          >
            <div v-if="user.admin_status == 0">
              <button
                @click="Admin(user.collaborator_id)"
                class="td-underline td-text-sm"
              >
                Make Admin
              </button>
            </div>
            <div v-else-if="user.admin_status == 1">
              <small><u>Make Collaborator</u></small>
            </div>
            <div>
              <small><u>Remove</u></small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
// import { GetWorkspaceUsers } from '@zuri/control'
import axios from 'axios';

export default {
  name: 'currentCollab',
  data() {
    return {
      collaborators: [],
      showLoading: false,
    };
  },

  computed: {
    ...mapGetters({
      selectedTodo: 'todos/selectedTodo',
      user: 'todos/user',
      org_id: 'todos/organization',
    }),
  },
  methods: {
    getIndDetails() {
      this.selectedTodo.collaborators.forEach((element) => {
        element.collaborator_id;
        axios
          .get(
            `https://api.zuri.chat/organizations/${this.user.currentWorkspace}/members?query=${this.user._id}`,
            // `https://api.zuri.chat/users/${element.collaborator_id}`,
            {
              headers: {
                Authorization: `Bearer ${this.user.token}`,
              },
            },
          )
          .then((response) => {
            // this.collaborators.push(response.data)
            response;
            console.log(response);
          })
          .catch((error) => {
            console.log(error);
          });
      });
    },
    Admin(collaborator_id) {
      console.log(this.user[0]);
      axios
        .put(
          `admin-privilege/${this.selectedTodo._id}?user_id=${this.user[0]._id}&organisation_id=${this.selectedTodo.organisation_id}`,
          {
            privilege: 1,
            creator_id: `${this.user[0].id}`,
            collaborator_id,
          },
        );
    },
  },
  mounted() {
    //    this.getUser()
    //    console.log(this.selectedTodo)
    this.collaborators = this.selectedTodo;
    this.getIndDetails();
  },
};
</script>

<style scoped>
.box {
  overflow-y: scroll;
  max-height: 20em;
}
</style>
