<template>
  <!-- view for all pages -->
  <div id="view_section">
    <!-- the todo nav component -->
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
import links from "./plugins/links.js";
import TodoNav from './components/TodoNav';
import AddTaskBtn from './components/AddTaskBtn';
import TodoForm from "./components/TodoForm";
import ShareModal from "./components/shareModal";

export default {
  name: "view",
  data() {
    return { 
     showTodoForm: false 
    };
  },
  methods: {
    toggleModal() {
            console.log("hi");
            this.showTodoForm = !this.showTodoForm;
        },
  },
  beforeMount() {
    // this.appendLinks()
  },
  components: {
    TodoForm,
    TodoNav,
    AddTaskBtn,
    ShareModal
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
