<template>
  <div id="view_section">
    <!-- <h3>
            This is where we will be working
        </h3> -->
    <div
      class="flex-grow px-4"
      :class="isComment ? 'hide' : 'show'"
    >
      <div id="header">
        <div
          id="logo "
          class="flex items-center flex-row"
        >
          <img
            class="w-8 m-4"
            :src="'./img/zuri-logo.svg'"
          />
          <span class="font-bold text-lg">Zuri</span>
      </div>
  </div>

  <!-- <AddTaskForm /> -->
  <!-- transition for the modal components -->
  <transition name='fade'>
    <TaskForm
      v-if="isModal"
      @toggleModal='toggleModal'
    />
  </transition>
  <transition name='fade'>
    <shareModal
      v-if="isShareModal"
      @toggleShareModal='toggleShareModal'
    />
  </transition>
  <!-- the create task button -->
  <!-- <AddTaskBtn @click="isComment = !isComment" /> -->
  <AddTaskBtn @click="toggleModal" />
  <!-- the search input component working -->
  <SearchInput @searchTodo='searchTodo' />
  <!-- the todo nav component -->
  <TodoNav />
  <!-- the grid div tag for the todo container and the comment section -->
  <!-- <div></div> -->
  <div
    id="main_view"
    class="section_grid"
  >
    <div>
      <template v-if="showAll">
        <div class="todo_container  sm:grid sm:grid-cols-2 gap-4 md:grid-cols-3">
          <TodoCard
            v-for="(todo, index) in allTodos"
            :key="index++"
            :todo="todo"
            @showComment="showComment"
            @toggleShareModal = "toggleShareModal"
          />

        </div>
      </template>
      <template v-else>
        <div class="todo_container  sm:grid sm:grid-cols-2 gap-4 md:grid-cols-3">
          <TodoCard
            v-for="(todo, index) in searchedValues"
            :key="index"
            :title="todo.title"
            :date="todo.startDate"
            :description="todo.description"
          />
        </div>
      </template>
    </div>
    <!-- comment section still under construction -->
    <!-- <div id="comment"> -->
    <!-- // <router-view /> -->
    <!-- </div> -->
    </div>
    </div>
    <!-- <AddTaskForm /> -->
    <!-- transition for the modal components -->
    <transition name='fade'>
      <TaskForm
        v-if="isModal"
        @toggleModal='toggleModal'
      />
    </transition>
    <!-- the create task button -->

    <!-- the grid div tag for the todo container and the comment section -->
    <!-- <div></div> -->

    <!-- comment section still under construction -->
    <div
      id="comment"
      class="px-2"
      v-if="isComment"
      :class="isComment ? 'show' : 'hide'"
    >
      <router-view
        @hideComment="hideComment"
        @showComment="showComment"
      />

      </div>
      </div>
</template>
<script>
import SearchInput from "../components/Search-Input.vue";
import TodoCard from "../components/TodoCard.vue";
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
      isComment: false,
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
    isMobile() {
      if (
        /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
          navigator.userAgent
        )
      ) {
        return true;
      } else {
        return false;
      }
    },
    showComment() {
      this.isComment = true;
    },
    hideComment() {
      this.isComment = false;
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
    check() {
      if (this.$route.params.id) {
        this.showComment();
      } else {
        this.hideComment();
      }
    },
  },
  mounted() {
    this.check();
  },
  components: {
    TodoCard,
    SearchInput,
    TodoNav,
    AddTaskBtn,
    AddTaskForm,
    shareModal,
    TaskForm,
  },
};
</script>
<style lang="scss">
#view_section {
  display: flex;
}

@media (min-width: 786px) {
  #view_section {
    padding: 0 0 0 2rem;
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