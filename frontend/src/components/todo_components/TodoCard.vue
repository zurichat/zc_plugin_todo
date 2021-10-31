<template>
    <div
        id="TodoCard"
        class="td-px-4 td-py-2 td-mx-auto td-border td-rounded td-cursor td-my-4 sm:td-my-0 taskcard sm:td-mx-0 td-relative"
    ><div v-click-away="ClickAway">
            <div
                class="menu_btn td-px-6 td-py-3 td-absolute td-top-0 td-right-0"
                @click="toggleMenu"
            >
                <i class="pi pi-ellipsis-v"></i>
            </div>
            <MenuDropdown
                :links="links"
                v-show="isModalVisible"
                :todo="todo"
                @toggleDeleteModal="toggleDeleteModal"
                @toggleMenu="toggleMenu"
                @toggleAssignModal="toggleAssignModal"
                @archived="handleArchivedTodo"
            />

        </div>
        <div >
            <div class="td-flex td-justify-between">
                <div id="card_title td-py-3">
                    <p class="title td-font-bold td-py-1 td-text-sm td-capitalize">
                        {{ todo.title }}
                    </p>
                    <p
                        class="description  td-text-gray-500 td-text-sm "
                    >
                        {{ description }}...
                    </p>
                </div>
            </div>        <hr class="td-mt-4 "/>
        <div id="progress_container" >
            <progress
                id="progress"
                class="td-w-full td-mx-auto"
                :value="percent"
                max="100"
            >
                32%
            </progress>
            <div id="task_preview" class="td-flex  ">
                <div class="mark_icon">
                   <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect y="0.5" width="18" height="18" rx="2" fill="#00B87C"/>
                    <path d="M13.5 6.6875L7.3125 12.875L4.5 10.0625" stroke="white" stroke-width="1.22693" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                </div>
                <p id="details" class="td-flex td-px-2 td-items-center td-text-gray-600 td-font-semibold td-text-sm">{{completedTask.length}}/{{ todo.tasks.length }} tasks ({{percent + '%'}} Completed)</p>
            </div>
        </div>
        <div id="date_container" class="td-flex td-my-2 td-items-center">
            <div id="todo_date" class="td-flex td-items-center td-text-gray-600  td-text-xs">
                <i class="pi pi-calendar"></i>
                <span class="td-px-1">Sept 20, 2021</span>
            </div>
            <span class="td-text-gray-500 td-font-bold td-px-2">
                <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.04 2.025C0.04 1.76833 0.0883334 1.52667 0.185 1.3C0.285 1.07333 0.418333 0.876667 0.585 0.71C0.751667 0.54 0.946667 0.406666 1.17 0.31C1.39667 0.21 1.63667 0.16 1.89 0.16C2.14667 0.16 2.38833 0.21 2.615 0.31C2.84167 0.406666 3.03833 0.54 3.205 0.71C3.375 0.876667 3.50833 1.07333 3.605 1.3C3.705 1.52667 3.755 1.76833 3.755 2.025C3.755 2.28167 3.705 2.52333 3.605 2.75C3.50833 2.97333 3.375 3.16833 3.205 3.335C3.03833 3.50167 2.84167 3.635 2.615 3.735C2.38833 3.83167 2.14667 3.88 1.89 3.88C1.63667 3.88 1.39667 3.83167 1.17 3.735C0.946667 3.635 0.751667 3.50167 0.585 3.335C0.418333 3.16833 0.285 2.97333 0.185 2.75C0.0883334 2.52333 0.04 2.28167 0.04 2.025Z" fill="#616061"/>
                </svg>
                </span>
            <div class="td-text-center">
                <span class="td-text-green-500 td-bg-green-100 td-h-5 td-rounded td-px-1 td-py-0.5 td-text-xs td-select-none">
                    20 days left
                </span>
            </div>
            <span class="td-text-xs"></span>
        </div>
        <div class="td-flex td-justify-between  td-mt-4 td-items-center">
            <div id = "collaborators" class="td-flex td-border td-rounded-md td-items-center">
                <img src="../../assets/img/collaborators.svg" />
                <span
                    class=" td-mx-0.5  td-h-6 td-rounded td-px-2 td-py-1 td-text-xs td-select-none"
                   >20</span
                 >
            </div>
            <div id="todo_link" @click="details()">
                <span class="td-underline td-cursor-pointer td-font-medium td-text-green-400">View Task</span>
            </div>
        </div>
    </div>
     <transition name="fade">
            <DeleteModal
                v-if="isDeleteModal"
                :title="todo.title"
                :id="todo._id"
                @deleteItem="deleteItem"
                @toggleDeleteModal="toggleDeleteModal"
            />
        </transition>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import DeleteModal from '../DeleteModal';
import MenuDropdown from '../MenuDropdown.vue';
//  import AssignForm from "./collaborators/collaboratorModal.vue";

export default {
  name: 'TodoCard',
  data() {
    return {
      isModalVisible: false,
      isDeleteModal: false,
      isAssignModal: false,
      links: [
        {
          name: 'Edit',
          action: () => {
            this.toggleMenu();
            // this.$emit('toggleShareModal')
            // alert('You cant assign tasks now')
          },
          type: 'default',
        },
        {
          name: 'Delete',
          action: () => {
            this.toggleMenu();
            alert('completed');
          },
          type: 'default',
        },
      ],
    };
  },
  components: {
    MenuDropdown,
    //   CircleProgress,
    DeleteModal,
    //  AssignForm
  },
  computed: {

    // function to get user object from vuex store
    ...mapGetters({
      user: 'user/user',
    }),

    description() {
      let value = 1;
      if (this.todo.description != undefined) {
        value = this.todo.description.slice(0, 20);
      }
      return value;
    },
    percent() {
      const all = this.todo.tasks;
      let value = 0;
      if (all.length != 0) {
        const completed = all.filter((task) => task.status === 1);
        value = (completed.length / all.length) * 100;
      }
      return Math.round(value);
    },
    collaborators() {
      let value = '';
      if (this.todo.colaborators === undefined) {
        value = this.todo.collaborators.length;
      } else {
        value = this.todo.colaborators.length;
      }
      return value;
    },
    completedTask() {
      const completed = this.todo.tasks.filter((task) => task.status === 1);
      return completed;
    },

  },
  methods: {
    ...mapActions({
      delete: 'todos/ADD_TRASH',

      archive: 'todos/ADD_ARCHIVE',
    }),
    deleteItem(any) {
      this.delete(any);
    },
    toggleDeleteModal() {
      this.isDeleteModal = !this.isDeleteModal;
    },
    toggleAssignModal() {
      this.isAssignModal = !this.isAssignModal;
    },
    ClickAway() {
      this.isModalVisible = false;
    },
    details() {
      this.$router.push({
        name: 'Detail',
        params: { id: this.todo._id },
      });
    },
    toggleMenu() {
      this.isModalVisible = !this.isModalVisible;
    },

    closeModal() {
      this.isModalVisible = false;
    },
    alert() {
      alert('hi');
    },
    handleArchivedTodo() {
      this.$emit('archived', this.todo);
    },
  },

  props: {
    todo: {
      type: Object,
    },
  },
};
</script>
<style lang="scss" scoped>
#TodoCard {
    background: #ffffff;
    // border: 1px solid #dadada;
    box-sizing: border-box;

    max-width: 30em;
    box-shadow: 0px 0px 15px #e7e7e7de;
}
progress[value] {
  /* Reset the default appearance */
  -webkit-appearance: none;
   appearance: none;
  border-radius: .6em;
  height: 3px;
  //  box-shadow: 0 0 10px rgb(0 103 69 / 28%);
}
progress[value]::-webkit-progress-bar {

  border-radius: 2px;
  background-color: #E1FDF4;
}
progress[value]::-webkit-progress-value {
  background-color: #00B87C;
  border-radius: 2px;
}

#progress{
  height: .3rem;
  border-radius: 4px;
}
</style>
