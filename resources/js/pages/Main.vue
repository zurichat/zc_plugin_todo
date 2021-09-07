<template>
  <div class="grid grid-cols-2">
    <!-- <h3>
            This is where we will be working
        </h3> -->
    <div>
      <div id="header">
        <div id="logo " class="flex items-center flex-row">
          <img class="w-8 m-4" :src="'./img/zuri-logo.svg'" />
          <span class="font-bold text-lg">Zuri</span>
        </div>
      </div>
      <!-- <AddTaskForm /> -->
      <!-- transition for the modal components -->
      <transition name='fade'>
        <TaskForm v-if="isModal" @toggleModal='toggleModal' />
      </transition>
      <transition name='fade'>
        <shareModal v-if="isShareModal" @toggleShareModal='toggleShareModal' />
      </transition>
      <!-- the create task button -->
      <AddTaskBtn @click="toggleModal" />
      <button @click="toggleShareModal">Share</button>
      <!-- the search input component working -->
      <SearchInput @searchTodo='searchTodo' />
      <!-- the todo nav component -->
      <TodoNav />
      <!-- the grid div tag for the todo container and the comment section -->
      <!-- <div></div> -->
      <div id="main_view" class="section_grid">
        <div>
          <template v-if="showAll">
            <div class="todo_container  sm:grid sm:grid-cols-2 gap-4 md:grid-cols-3">
              <taskCard v-for="(todo, index) in allTodos" :key="index" :title="todo.title" :date="todo.startDate"
                :description="todo.description" />
            </div>
          </template>
          <template v-else>
            <div class="todo_container  sm:grid sm:grid-cols-2 gap-4 md:grid-cols-3">
              <taskCard v-for="(todo, index) in searchedValues" :key="index" :title="todo.title" :date="todo.startDate"
                :description="todo.description" />
            </div>
          </template>
        </div>
        <!-- comment section still under construction -->
        <div id="comment">
          <!-- // <router-view /> -->
        </div>
      </div>
    </div>
    <div></div>
  </div>
</template>
<script>
  import SearchInput from "../components/Search-Input.vue";
  import taskCard from "../components/taskCard.vue";
  import TodoNav from "../components/TodoNav.vue";
  import AddTaskForm from "../components/addTaskForm.vue";
  import AddTaskBtn from "../components/AddTaskBtn.vue";
  import TaskForm from "../components/TaskForm";
  import shareModal from "../components/shareModal";
  import { mapGetters } from "vuex";
  export default {
    name: "Main",
    data() {
      return {
        isModal: false,
        isShareModal: false,
        showAll: true,
        searchedValues: [],
      };
    },
    computed: {
      ...mapGetters({
        allTodos: "todos/allTodos",
      }),
    },
    methods: {
      toggleModal() {
        console.log("hi");
        this.isModal = !this.isModal;
      },
      toggleShareModal() {
        console.log("hi");
        this.isShareModal = !this.isShareModal;
      },
      searchTodo(val) {
        if (val === "") {
          this.showAll = true;
        } else {
          this.showAll = false;
          this.searchedValues = this.allTodos.filter(
            todo => todo.title.toLowerCase().indexOf(val.toLowerCase()) >= 0
          );
        }
      },
    },
    components: {
      taskCard,
      SearchInput,
      TodoNav,
      AddTaskBtn,
      AddTaskForm,
      shareModal,
      TaskForm,
    },
  };
</script>