<template>
  <!-- view for all pages -->
  <div id="view_section" class="mx-5">
    <!-- the todo nav component -->
    <SearchInput @searchTodo="searchTodo" />
    <div
      class="
        flex flex-col
        md:flex-row
        flex-start
        justify-start
        md:items-center
        md:justify-between
      "
    >
      <TodoNav @showLabel="showEditModal = true" />
      <AddTaskBtn @click="toggleModal" />
    </div>
    <router-view />
    <todo-form @toggleModal="toggleModal" v-if="showTodoForm" />
  </div>
</template>
<script>
import { mapActions } from 'vuex';
import { mapGetters } from "vuex";
import links from "./plugins/links.js";
import TodoNav from './components/TodoNav';
import AddTaskBtn from './components/AddTaskBtn';
import TodoForm from "./components/TodoForm";
import ShareModal from "./components/shareModal";
import SearchInput from './components/Search-Input';

export default {
  name: "view",
  data() {
    return { 
     showTodoForm: false 
    };
  },
  methods: {
    ...mapActions({
      searchValue: 'todos/SEARCH'
    }),
    toggleModal() {
            console.log("hi");
            this.showTodoForm = !this.showTodoForm;
        },
    searchTodo(val) {
      this.searchValue(val);
    },
  },
  beforeMount() {
    // this.appendLinks()
  },
  computed: {
        ...mapGetters({
          allTodos: "todos/allTodos",
          result: "todos/searchedTodo",
          showAll: "todos/showAll",
        }),
  },
  components: {
    TodoForm,
    TodoNav,
    AddTaskBtn,
    ShareModal,
    SearchInput
  }
}
</script>

<style lang='scss'>
#view_section {
  // display: flex;
  font-family: "Lato", sans-serif !important;
}

@media (min-width: 786px) {
  #view_section {
    // padding: 0 2rem;
  }
}

#comment {
  min-height: 100vh;
  width: 100%;
  border-left: 0.5px solid lightgrey;
}

@media (min-width: 768px) {
  #comment {
    width: 25%;
  }
}

// #comment.hide {
//   display: none
// }

// #comment.show {
//   display: block
// }

@media (max-width: 768px) {
  .hide {
    display: none;
  }

  #view_section {
    display: block !important;
  }
}
</style>
