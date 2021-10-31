<template>
  <div class="td-w-full td-flex-grow">
    <div id="Details" class="">
      <div
        class="
          todo-nav
          td-px-4 td-bg-green-500 td-flex td-justify-between td-items-center
        "
      >
        <div
          class="p-2"
          @click="
            () => {
              this.$router.push({ name: 'Main' });
            }
          "
        >
          <i class="pi pi-arrow-left td-text-white"></i>
        </div>
        <div class="td-flex td-items-center">
          <h1 class="td-px-2 td-py-2 td-text-white td-text-2xl">
            # To-do-list
          </h1>
          <span class="btn"
            ><i class="pi td-px- td-text-white pi-chevron-down"
          /></span>
        </div>
      </div>
      <div
        class="
          header
          td-px-2
          td-py-4
          td-flex
          td-justify-between
          td-items-center
          td-border-b-2
        "
      >
        <div>
          <h2 class="td-text-xl td-font-bold td-text-green-500">
            <i class="pi pi-calendar td-px-2"></i>{{ selectedTodo.title }}
          </h2>
        </div>
        <div class="td-flex td-flex-row td-items-center">
          <div class="todo-headerRight">
            <!-- <a class="commentIcon"><img src="/img/Rectangle 892.png" alt="reply"></a> -->
            <div class="todo-profileImg td-flex td-items-center">
              <div class="todo-profile profileOne">
                <img
                  src="../assets/img/collaborators.svg"
                  style="border: 1px solid rgb(1, 216, 146); border-radius: 4px"
                />
              </div>

              <p class="text-300">2</p>
            </div>
          </div>

          <div class="td-relative" v-click-away="ClickAway">
            <span
              @click="assign()"
              class="
                td-bg-green-500
                td-h-10
                td-w-10
                td-mx-2
                td-justify-center
                td-flex
                td-items-center
                td-rounded-xl
              "
              ><i class="pi td-text-white pi-user-plus td-cursor-pointer"
            /></span>
            <div
              v-if="isAssign"
              class="
                user_dropdown
                td-absolute
                td-p-2
                td-bg-white
                td-rounded
                td-shadow
                td-border
                td-mt-12
                td-top-0
                td-right-0
              "
            >
              <input
                @input="search()"
                v-model="value"
                class="
                  td-rounded
                  td-border-green-300
                  td-mx-auto
                  td-w-11/12
                  td-border
                  td-py-2
                  td-px-2
                  hover:td-border-green-500
                  td-outline-none
                "
                type="text"
              />
              <div class="td-h-64 td-w-64 td-overflow-y-scroll">
                <label
                  @click="assign()"
                  :for="user.name.first"
                  v-for="(user, index) in users"
                  :key="index"
                  class="
                    td-flex
                    hover:td-border
                    td-text-gray-500
                    hover:td-text-white hover:td-bg-green-500
                    td-border-b td-p-2 td-my-2 td-pb-2 td-items-center
                  "
                >
                  <span class="tracking-wide td-px-2 td-font-bold">{{
                    user.name.first + " " + user.name.last
                  }}</span></label
                >
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        class="
          sub-header
          td-px-2
          td-flex
          td-py-3
          td-justify-between
          td-items-center
          td-border-b-2
        "
      >
        <div class="td-flex" @click="isModal = true">
          <div
            class="
              mr-2
              font-bold
              button
              td-px-4
              td-py-2
              td-bg-green-500
              td-cursor-pointer
              td-rounded
              td-text-white
            "
          >
            + Add a new Task
          </div>
          <div class="amt_completed td-px-4 td-py-2 td-flex td-items-center">
            <svg
              width="19"
              height="19"
              viewBox="0 0 19 19"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M10.9999 1.82458H4.99988C4.17145 1.82458 3.49988 2.49616 3.49988 3.32459V15.3246C3.49988 16.153 4.17145 16.8246 4.99988 16.8246H13.9999C14.8283 16.8246 15.4999 16.153 15.4999 15.3246V6.32459L10.9999 1.82458Z"
                stroke="#242424"
                stroke-width="1.22693"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10.9999 1.82458V6.32459H15.4999"
                stroke="#242424"
                stroke-width="1.22693"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12.4999 10.0747H6.49988"
                stroke="#242424"
                stroke-width="1.22693"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12.4999 13.0747H6.49988"
                stroke="#242424"
                stroke-width="1.22693"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M7.99988 7.07458H7.24988H6.49988"
                stroke="#242424"
                stroke-width="1.22693"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>

            <span class="td-font-bold">{{ itemsTodo.length }} completed</span>
          </div>
        </div>
        <div class="progress_container td-flex td-flex-col">
          <span class="progress_text td-self-end td-text-sm td-font-medium"
            >{{ percent }}/100%</span
          >
          <progress
            id="progress"
            class="td-w-full td-mx-auto"
            :value="percent"
            max="100"
          >
            32%
          </progress>
        </div>
      </div>
      <div class="td-p-2 description">
        <span>{{ selectedTodo.description }}</span>
      </div>

      <div class="tasks_container td-px-2 td-py-4">
        <div class="td-my-4 td-px-2 tabMenu">
          <span
            class="task_head td-font-bold td-mr-4 td-text-green-500"
            @click="isSelect('1')"
            >Pending</span
          >
          <span class="ml-8 task_head td-font-bold" @click="isSelect('2')"
            >Completed</span
          >

          <div class="tabContents">
            <template id="task_container" v-if="selectedTodo.tasks.length <= 0">
              <div>
                <Empty
                  :title="'Oops Your Have no tasks yet'"
                  :subtitle="'Click Create Task Button'"
                />
              </div>
            </template>

            <template v-else>
              <TaskCard
                :task="task"
                :index="index"
                v-for="(task, index) in selectedTodo.tasks"
                :key="index"
              />
            </template>
          </div>
        </div>
      </div>
    </div>
    <!-- <div id="Comment" class="flex-shrink-0 w-1/4 border"></div> -->
    <!-- <div class="flex flex-row td-justify-between td-items-center">
      {{this.$route.params.id}}
      <div @click="close" class="font-bold text-green-500">X</div>
      </div>
      <p class="font-bold text-green-500 ">
        This is the todo details section,

      </p>
      <p class="text-lg font-bold text-red-500 text-wrap">Still under construction</p> -->
    <!-- <div>
        <div>
          <p>Task Title</p>
        <span>Created On: 12/03348n/39424</span>
        <p>oihsoiv hwt0pu;n4wy0iohjgwklef</p>
        </div>
        <div>
          <p>Task Title</p>
          <div>

          </div>
        </div>
        <div class="flex">
          <div>
            <p>Due Date</p>
            <span>p320409</span>
          </div>
          <div>
            <p>Worked </p>
            <span>loiwheot</span>
          </div>
        </div>
      </div> -->
    <!-- <TextArea /> -->
    <transition name="fade">
      <TaskForm
        v-if="isModal"
        @createTask="createTask"
        @toggleModal="toggleModal"
      />
    </transition>
  </div>
</template>
<script>
import axios from 'axios';
import { mapGetters } from 'vuex';
import CentrifugeSetup from '../plugins/realtime';
import TaskForm from '../components/task_components/TaskForm';
import Empty from '../components/Empty';
import TaskCard from '../components/task_components/TaskCard';
// import TextArea from '../components/TextArea.vue\
// import CommentBox from '../components/CommentBox.vue'

export default {
  name: 'TodoDetails',
  data() {
    return {
      isActive: '1',
      // centrifuge: null,
      checked: [],
      isModal: false,
      selectedTodo: null,
      isAssign: false,
      alltasks: ['', '', '', '', '', ''],
      users: [],
      value: '',
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

    itemsTodo() {
      return this.checked.filter((todo) => !todo.completed);
    },
  },
  components: {
    TaskCard,
    TaskForm,
    Empty,
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
          {
            console.log(ctx.data.details);
            _this.selectedTodo = ctx.data.details;
          }
          break;
        default:
      }
    },
    check() {
      const { id } = this.$route.params;
      const _this = this;
      this.selectedTodo = this.allTodos.find(
        (todo) => todo._id.toLowerCase() === id.toLowerCase(),
      );
      if (this.selectedTodo <= 0 || this.selectedTodo === undefined) {
        this.$router.push({ path: '/' });
      } else {
        CentrifugeSetup(_this.selectedTodo.channel, this.checkAction);
      }
      console.log(this.selectedTodo);
    },
    getUser() {
      axios
        .get('https://randomuser.me/api/?results=15')
        .then((response) => (this.users = response.data.results));
    },
  },
  mounted() {
    this.getUser();
  },
  beforeMount() {
    this.check();
  },
};
</script>
<style lang="scss" scoped>
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
</style>
