<template>
  <div class="td-w-full td-flex-grow ">
    <div id="Details" class="">
      <div class="todo-nav td-px-4 td-bg-green-500 td-flex td-justify-between td-items-center">
        <div class="td-flex td-items-center">
          <h1 class="td-px-2 td-py-2 td-text-white td-text-xl">
            # To-do-list
          </h1>
          <span class="btn">
            <i
              class="pi td-px-
                                    td-text-white pi-chevron-down"
            />
          </span>
        </div>

        <div class="td-flex td-items-center"></div>
      </div>
      <div class="header td-px-2 td-py-4 td-flex td-justify-between td-items-center td-border-b-2">
        <div>
          <h2 class="td-text-lg td-font-bold td-text-black-500 title">
            {{ selectedTodo.title }}
          </h2>
          <div class="description ">
            <span>{{ selectedTodo.description }}</span>
          </div>
        </div>
        <div class="td-flex td-flex-row td-items-center">
          <!-- <div class="todo-headerRight">
          <a class="commentIcon"><img src="/img/Rectangle 892.png" alt="reply"></a>
          <div class="todo-profileImg td-flex td-items-center">
            <div class="todo-profile profileOne">
              <img src="../assets/img/collaborators.svg" style="border: 1px solid rgb(1, 216, 146); border-radius: 4px;">
            </div>

            <p class="text-300">{{ Collaborators }}</p>
          </div>
        </div> -->

          <div
            class=""
            @click="
              () => {
                this.$router.push({ name: 'Main' });
              }
            "
          >
            <p class="td-underline td-text-sm td-text-green-400">
              Return to To-do list
            </p>
          </div>
        </div>
      </div>
      <div
        class="sub-header td-px-2 td-flex td-py-3 td-justify-between td-items-center td-border-b-2"
      >
        <div class="td-flex td-items-center">
          <p class="td-font-bold">Tasks</p>
        </div>
        <div class="td-flex td-items-center">
          <div
            class="mr-2 td-p-2 button td-bg-gray-200 td-mx-4 td-cursor-pointer td-rounded "
            @click="isModal = true"
          >
            + Add a new Task
          </div>

          <!-- Add collaborator -->
          <div
            class="mr-2 td-relative td-p-2 button td-bg-gray-200 td-mx-4 td-cursor-pointer td-rounded"
            v-click-away="ClickAway"
          >
            <span @click="assign()" class="td-justify-center td-flex td-items-center ">
              <i class="pi pi-user-plus td-cursor-pointer td-px-1" /> Add collaborator
              <span class="td-px-1">
                <span
                  style="background-color:#00b87c"
                  class="td-rounded-full td-h-5 td-w-5 td-text-white td-flex td-items-center td-justify-center"
                >
                  <small>{{ totalCollab }}</small>
                </span>
              </span>
            </span>
            <div
              v-if="isAssign"
              class="user_dropdown td-absolute td-p-2 td-bg-white td-rounded td-shadow td-border td-mt-12 td-top-0 td-right-0"
            >
              <input
                @input="search()"
                v-model="value"
                class="td-rounded td-border-green-300 td-mx-auto td-w-11/12 td-border td-py-2 td-px-2 hover:td-border-green-500 td-outline-none"
                type="text"
              />
              <div style="min-width:40rem" class="td-h-64 td-w-100 td-overflow-y-scroll">
                <label v-if="showLoading" class="td-w-100 td-flex td-justify-center">
                  <i class="pi pi-spin pi-spinner" style="font-size: 2rem"></i>
                </label>
                <div
                  v-else
                  :for="user.user_name"
                  v-for="(user, index) in users"
                  :key="index"
                  class="td-flex hover:td-border td-text-gray-500 hover:td-text-white hover:td-bg-green-500 td-border-b td-p-2 td-my-2 td-pb-2 td-items-center"
                >
                  <div style=" width:100%" class="td-flex td-justify-between">
                    <div class="tracking-wide  td-px-2 td-font-bold">{{ user.user_name }}</div>
                    <div class="td-justify-self-end">
                      <button
                        v-if="!user.collaborator || user.collaborator == false"
                        class="td-border-2 hover:td-shadow td-p-1 td-rounded td-border-white td-bg-green justify-self-end"
                        @click="toggleCollab(user, index, true)"
                      >
                        Add
                      </button>

                      <button
                        v-if="user.collaborator == true"
                        class="hover:td-shadow  td-border-2 td-border-white td-p-1 td-rounded td-bg-red justify-self-end"
                        @click="toggleCollab(user, index, 'admin')"
                      >
                        Make Admin
                      </button>

                      <button
                        v-if="user.collaborator == true"
                        class="hover:td-shadow  td-border-2 td-border-white td-p-1 td-rounded td-bg-red justify-self-end"
                        @click="toggleCollab(user, index, false)"
                      >
                        Remove
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Collaborator admin -->
          <span @click="assign()" class="td-justify-center td-flex td-items-center ">
            <i class="pi pi-user-plus td-cursor-pointer td-px-1" /> Admin
            <span class="td-px-1">
              <span
                style="background-color:#00b87c"
                class="td-rounded-full td-h-5 td-w-5 td-text-white td-flex td-items-center td-justify-center"
              >
                <small>{{ totalCollabAdmin }}</small>
              </span>
            </span>
          </span>
        </div>
      </div>

      <div class="tasks_container td-px-2 td-py-4">
        <div class="td-my-4 td-px-2 tabMenu">
          <div class="td-mb-4">
            <span
              :class="isPending ? 'active' : ''"
              class="task_head tab td-font-bold td-mr-4 td-my-4 td-py-2 "
              @click="isPending = true"
              >Pending</span
            >
            <span
              :class="isPending ? '' : 'active'"
              class="ml-8 task_head tab td-my-4 td-py-2 td-font-bold"
              @click="isPending = false"
              >Completed</span
            >
          </div>
          <div class="tabContents">
            <template id="task_container" v-if="selectedTodo.tasks.length <= 0">
              <div>
                <Empty :subtitle="'task'" />
              </div>
            </template>

            <template v-else>
              <div id="pending" v-if="isPending">
                <TaskCard
                  :task="task"
                  :index="index"
                  v-for="(task, index) in pendingTask"
                  :key="index"
                  @showComment="showComment"
                  @completeTask="completeTask"
                />
              </div>
              <div id="completed" v-else>
                <TaskCard
                  :task="task"
                  :index="index"
                  v-for="(task, index) in completedTask"
                  :key="index"
                  @showComment="showComment"
                  @completeTask="completeTask"
                />
              </div>
            </template>
            <div
              v-show="isComment"
              id="Comment"
              class="td-hidden lg:td-block td-rounded-md td-flex-shrink-0 td-w-1/4 td-border td-flex td-flex-col"
            >
              <Comment @showComment="showComment" :selectedTodo="selectedTodo.title" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <transition name="fade">
            <CollabModal />
        </transition> -->

    <transition name="fade">
      <TaskForm v-if="isModal" @createTask="createTask" @toggleModal="toggleModal" />
    </transition>
    <transition name="fade" class="td-block lg:td-hidden">
      <Comment v-if="isComment" @showComment="showComment" :selectedTodo="selectedTodo.title" />
    </transition>
  </div>
</template>
<script>
// import CollabModal from '../components/collaborators/currentCollaborators'
import axios from 'axios';
import { mapGetters } from 'vuex';
import CentrifugeSetup from '../plugins/realtime';
import TaskForm from '../components/task_components/TaskForm.vue';
import Empty from '../components/Empty.vue';
import TaskCard from '../components/task_components/TaskCard.vue';
import Comment from '../components/comment.vue';

export default {
  name: 'TodoDetails',
  data() {
    return {
      isActive: '1',
      // centrifuge: null,
      isComment: false,
      isPending: true,
      checked: [],
      isModal: false,
      selectedTodo: null,
      isAssign: false,
      alltasks: ['', '', '', '', '', '', '', '', '', ''],
      users: [],
      totalUsers: [],
      value: '',
      showLoading: false,
      totalCollab: 0,
      totalCollabAdmin: 0,
    };
  },
  computed: {
    ...mapGetters({
      allTodos: 'todos/allTodos',
      isUser: 'todos/user',
      centrifuge: 'todos/centrifuge',
    }),
    collaborators() {
      let value = '';
      if (this.todo.colaborators === undefined) {
        value = this.todo.collaborators.length;
      } else {
        value = this.todo.colaborators.length;
      }
      return value;
    },
    percent() {
      return (this.checked.length / this.alltasks.length) * 100;
    },
    pendingTask() {
      const pending = this.selectedTodo.tasks.filter((task) => task.status === 0);
      return pending;
    },
    completedTask() {
      const completed = this.selectedTodo.tasks.filter((task) => task.status === 1);
      return completed;
    },
    itemsTodo() {
      return this.checked.filter((todo) => !todo.completed);
    },
  },
  components: {
    TaskCard,
    TaskForm,
    Empty,
    Comment,
    // CollabModal
  },
  methods: {
    toggleModal() {
      this.isModal = !this.isModal;
    },
    isSelect(num) {
      this.isActive = num;
    },

    close() {
      this.$emit('hideComment');
    },
    ClickAway() {
      this.isAssign = false;
    },
    showComment() {
      this.isComment = !this.isComment;
    },
    async createTask(data) {
      const todo_id = this.selectedTodo._id;
      const { org_id } = this.isUser['0'];
      // this.isUser.Organizations[0];
      await axios
        .put(`/add-task/${todo_id}?organisation_id=${org_id}`, data)
        .then((response) => console.log('task created', response))
        .catch((error) => {
          if (error.response) {
            // The request was made and the server responded with a status code
            // that falls out of the range of 2xx
            console.warn(error.response.data);
          } else if (error.request) {
            // The request was made but no response was received
            console.log(error.request);
          } else {
            // Something happened in setting up the request that triggered the Error
            console.log('Error', error.message);
          }
          console.log(error.config);
        });
    },
    assign() {
      this.isAssign = !this.isAssign;
    },
    checkAction(ctx) {
      const _this = this;
      // check if auth user id is same a subscriber id
      console.log(ctx.data);
      switch (ctx.data.action) {
        case 'create':
          console.log(ctx.data.details);
          _this.selectedTodo = ctx.data.details;
          break;
        case 'delete':

          console.log(ctx.data.details);
          _this.selectedTodo = ctx.data.details;

          break;
        default: {
          console.log(ctx.data.details);
          _this.selectedTodo = ctx.data.details;
        }
      }
    },
    check() {
      const { id } = this.$route.params;
      const _this = this;
      this.selectedTodo = this.allTodos.find((todo) => todo._id.toLowerCase() === id.toLowerCase());
      if (this.selectedTodo <= 0 || this.selectedTodo === undefined) {
        this.$router.push({ path: '/' });
      } else {
        CentrifugeSetup(_this.selectedTodo.channel, this.checkAction);
      }
      console.log(this.selectedTodo);
    },

    // COLLABORATOR CODE START HERE ==============BY TJ FAITH
    async getUser() {
      // axios.get('https://randomuser.me/api/?results=15').
      //     then(response => this.users = (response.data.results))
      this.showLoading = true;
      await axios
        .get(`https://api.zuri.chat/organizations/${this.isUser.currentWorkspace}/members`)
        // .then(response =>  this.users = (response.data.results))
        .then((response) => {
          this.showLoading = false;
          this.users = response.data.data;
          this.totalUsers = response.data.data;
          this.users.forEach((element, index) => {
            this.selectedTodo.collaborators.forEach((collab) => {
              if (element._id === collab.collaborator_id) {
                this.users[index].collaborator = true;
              }
            });
          });
          console.log(this.users);

          // console.log(response.data.data)
        })

        .catch((error) => {
          this.showLoading = false;
          console.log(error);
        });
    },

    //   THIS FUNCTON COUNT COLLABORATOR
    countCollaborator() {
      this.totalCollab = this.selectedTodo.collaborators.length;
    },

    countCollaboratorAdmin() {
      let counter = 0;
      this.selectedTodo.collaborators.forEach((element, index) => {
        if (this.selectedTodo.collaborators[index].admin_status === '1') {
          counter += 1;
        }
      });
      this.totalCollabAdmin = counter;
    },

    toggleCollab(user, index, value) {
      this.isAssign = false;
      if (value === true) {
        const data = {
          admin_status: '0',
          collaborator_id: user._id,
          user_id: this.isUser['0']._id,
          email: user.email,
          name: user.user_name,
        };
        axios
          .put(
            `https://todo.zuri.chat/api/v1/assign-collaborators/${this.selectedTodo._id}?organisation_id=${this.selectedTodo.organisation_id}`,
            data,
          )
          .then((request) => {
            console.log(request);
            if (request.data.status === 'success') {
              alert('Collaborator Added');
              // Update Selected Todo
              this.selectedTodo.collaborators.push(data);
              this.users[index].collaborator = value;
              this.countCollaborator();
            } else {
              alert('Oops..an error occured');
            }
            this.adding = false;
          })
          .catch((error) => {
            alert('Oops..an error occured');

            console.log(error);
            this.adding = false;
          });
      } else if (value === false) {
        // eslint-disable-next-line no-param-reassign
        user.collaborator = value;
        const newIndex = this.selectedTodo.collaborators.findIndex(
          (x) => x.collaborator_id === user._id,
        );
        this.selectedTodo.collaborators.splice(newIndex, 1);
        this.countCollaborator();
      } else if (value === 'admin') {
        // SET A COLLABORATOR AS ADMIN
        // CALL YOUR API HERE TO ADD ADMIN TO DATABASE =================================
        //    API
        //     API

        const newIndex = this.selectedTodo.collaborators.findIndex(
          (x) => x.collaborator_id === user._id,
        );
        this.selectedTodo.collaborators[newIndex].admin_status = value;
        this.countCollaboratorAdmin();
      }
      // alert(value)
    },

    search() {
      let value;
      if (this.value !== '') {
        value = this.totalUsers;
        this.users = value;
        value = this.users.filter(
          (user) => user.user_name.toLowerCase().indexOf(this.value.toLowerCase()) >= 0,
        );
        this.users = value;
      } else {
        this.users = this.totalUsers;
        console.log(this.users);
        // this.users = value;
        // alert(value)
      }

      this.searchValue = value;
    },
    // COLLABORATOR CODE END HERE =================================BY TJFAITH

    completeTask(any) {
      const todo_id = this.selectedTodo._id;
      const { org_id } = this.isUser['0'];
      const _this = this;
      const data = {
        status: any.status,
        user_id: _this.isUser['0']._id,
        task_id: any.id,
      };
      axios
        .put(`mark-task/${todo_id}?organisation_id=${org_id}`, data)
        .then((res) => console.log(res));
    },
    deleteTask(any) {
      const todo_id = this.selectedTodo._id;
      const { org_id } = this.isUser['0'];
      const data = {
        status: any.status,
        user_id: this.isUser['0']._id,
        task_id: any.id,
      };
      axios
        .put(`mark-task/${todo_id}?organisation_id=${org_id}`, data)
        .then((res) => console.log(res));
    },
  },
  mounted() {
    this.getUser();
    this.countCollaborator();
  },
  beforeMount() {
    this.check();
  },
};
</script>
<style lang="scss" scoped>
.description {
  color: #616061;
}

progress[value] {
  /* Reset the default appearance */
  -webkit-appearance: none;
  appearance: none;
  border-radius: 0.6em;
  height: 5px;
  //  box-shadow: 0 0 10px rgb(0 103 69 / 28%);
}

progress[value]::-webkit-progress-bar {
  border-radius: 2px;
  background-color: #e2ecf8;
}

progress[value]::-webkit-progress-value {
  background-color: #00b87c;
  border-radius: 2px;
}

#progress_container {
  min-width: 15em;
}

#progress {
  height: 1.1rem;
  border-radius: 4px;
}

.todo-profileImg {
  position: relative;
  background: #fff;
  border: 1px solid #f6f6f6;
  border-radius: 4px;
  width: 105px;
  height: 30px;
}

.todo-profileImg2 {
  position: relative;
  background: #fff;
  border-radius: 4px;
  width: 105px;
  height: 30px;
}

.todo-profile.profileOne {
  left: 2%;
  z-index: 1000;
}
.tab.active {
  color: #00b87c;
  position: relative;
}
.tab.active:before {
  background-color: #00b87c;
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  height: 4px;
  width: 40%;
  border-radius: 0.5em;
}
.todo-profile {
  position: absolute;
  border-radius: 4px;
  top: 7%;
}

.todo-profile.profileTwo {
  left: 19%;
  z-index: 500;
}

.todo-profile.profileThree {
  left: 35%;
}

.text-300 {
  position: absolute;
  top: 18%;
  right: 5%;
  font-size: 16px;
  font-weight: bold;
  z-index: 100;
  color: #000;
}

.tabMenu span {
  cursor: pointer;
}

a.router-link-exact-active {
  color: #00b87c;
}
input:checked ~ .dot {
  transform: translateX(100%);
  background-color: #48bb78;
}
</style>
