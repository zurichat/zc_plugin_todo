<template>
  <div class="td-mb-2 td-rounded-md task_box td-flex td-p-2 hover:td-shadow td-border">
    <!-- <Checkbox v-model="checked" :id="'city' + index" name="city" :value="'Chicago' + index" /> -->
    <div class="task_content td-flex-grow">
      <div class="td-flex td-justify-between">
        <p class="task_title td-pb-1 td-text-lg td-font-bold">
          <span class="task_number">Task 0{{ index + 1 }} -</span>
          {{ task.title }}
        </p>
        <div v-click-away="ClickAway" class="">
          <div @click="toggleMenu"><i class="pi pi-ellipsis-v td-cursor-pointer"></i></div>
          <div class="td-relative">
            <taskDropdown
              :task="task"
              :todo="todo"
              v-show="isModalVisible"
              @toggleDeleteModal="toggleDeleteModal"
              @toggleMenu="toggleMenu"
            />
          </div>
        </div>
      </div>
      <div class="td-flex-td-items-start td-pb-4">
        <div>
          <span class="due td-font-semibold td-border-r py-0 td-pr-4"
            ><i class="pi pi-calendar"></i> Due tomorrow</span
          >
          <span class="td-pl-4 td-text-gray-600"> Hide description</span>
        </div>
      </div>
      <div class="description">
        {{ task.title }}
      </div>
      <div class="task_details td-flex td-flex-row td-justify-between">
        <div class="task_comment-amt td-flex td-items-center">
          <div class="todo-profileImg2 td-flex">
            <div class="todo-profile profileOne">
              <img
                src="../../assets/img/collaborators.svg"
                style="border: 1px solid rgb(1, 216, 146); border-radius: 4px"
              />
            </div>
          </div>
          <span
            @click="displayComment"
            class="td-cursor-pointer td-font-bold td-text-sm td-text-green-500 td-px-3 td-underline"
            >5 comments</span
          >
          <span class="td-text-gray-500">&#8226;</span>
          <span class="td-pl-2 td-text-gray-400 td-text-sm td-pr-4">Last Comment 12 hours ago</span>
          <div class="td-text-gray-400 td-pl-4 td-border-l-2">
            <i class="pi pi-tag"></i><span class="td-px-2 td-capitalize td-text-sm">General</span>
          </div>
          <div class="td-text-gray-400 td-pr-1">
            <i class="pi pi-tag"></i><span class="td-px-2 td-capitalize td-text-sm">HNG</span>
          </div>
        </div>
        <div class="task_tag td-flex td-flex-row td-items-center">
          <button
            @click="mark(1)"
            v-if="task.status === 0"
            class="
              td-bg-green-500 td-text-white td-cursor-pointer td-p-2 td-rounded td-mr-2 td-mb-2
              hover:td-bg-green-600
            "
          >
            Mark as done
          </button>
          <button
            @click="mark(0)"
            v-else
            class="
              td-bg-green-500 td-text-white td-cursor-pointer td-p-2 td-rounded td-mr-2 td-mb-2
              hover:td-bg-green-600
            "
          >
            Mark as undone
          </button>
        </div>
      </div>
    </div>
    <transition name="fade">
      <deleteTask @delete="deleteItem" v-if="isDeleteModal" @toggleDeleteModal="toggleDeleteModal"
        >You are about to delete your Task. Task deleted are sent to the trash and they are
        automatically deleted after 30 days</deleteTask
      >
    </transition>
  </div>
</template>
<script>
// import Checkbox from 'primevue/checkbox';
import deleteTask from "../deleteTask.vue";

import taskDropdown from "./taskDropDown.vue";

export default {
  name: "TaskCard",

  components: {
    // Checkbox
    deleteTask,
    taskDropdown,
  },

  data() {
    return {
      isModalVisible: false,
      isDeleteModal: false,
    };
  },
  props: ["task", "index"],
  mounted() {},
  methods: {
    mark(any) {
      const data = {
        id: this.task.task_id,
        status: any,
      };
      this.$emit("completeTask", data);
    },
    deleteItem() {
      this.$emit("deleteTask", this.task.task_id);
    },
    toggleMenu() {
      this.isModalVisible = !this.isModalVisible;
    },
    toggleDeleteModal() {
      this.isDeleteModal = !this.isDeleteModal;
    },
    ClickAway() {
      this.isModalVisible = false;
      // this.$emit('toggleMenu')
    },
    displayComment() {
      this.$emit("showComment");
    },
  },
};
</script>
<style lang="scss" scoped>
.due {
  color: #00b87c;
  border-color: #b9b8b9;
}
</style>
