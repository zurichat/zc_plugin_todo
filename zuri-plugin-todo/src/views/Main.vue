<template>
  <div>
    <div class="">
      <div class="todo-nav td-px-4 td-bg-green-500 td-flex td-justify-between td-items-center">
        <div class="td-flex td-items-center">
          <h1 class="td-px-2 td-py-2 td-text-white td-text-xl">
            # To-do-list
          </h1>
          <span class="btn"
            ><i
              class="pi td-text-sm
                                    td-text-white pi-chevron-down"
          /></span>
        </div>

        <div class="td-flex td-items-center"></div>
      </div>
      <div class="td-flex-grow td-px-4">
        <!-- <SearchInput @searchTodo="searchTodo" /> -->
        <div
          class="
                        td-flex td-flex-col
                        md:td-flex-row
                        td-flex-start
                        td-justify-start
                        md:td-items-center
                        md:td-justify-between
                    "
        >
          <MainNav @showLabel="showEditModal = true" />
          <div>
            <button
              @click="toggleModal"
              class="td-bg-green-500
                        td-my-5 td-flex td-items-center td-py-3 td-px-4 td-rounded td-text-white"
            >
              create a new todo
            </button>
          </div>
          <!-- <CreateTodoBtn @click="toggleModal" />  -->
        </div>
      </div>
      <div class="td-px-1">
        <router-view />
      </div>

      <transition name="fade">
        <TodoForm v-if="isModal" @toggleModal="toggleModal" />
      </transition>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';
import TodoForm from '../components/todo_components/TodoForm.vue';
import MainNav from '../components/MainNav.vue';
// // import CreateTodoBtn from "../components/CreateTodoBtn";
// import SearchInput from "../components/SearchInput";
// import TodoCard from "../components/TodoCard.vue";
export default {
  name: 'New Main',
  data() {
    return {
      isModal: false,
      showAll: true,
      isComment: false,
      showEditModal: false,
      centrifuge: null,
    };
  },
  computed: {
    ...mapGetters({
      allTodos: 'todos/allTodos',
      isAssign: 'todos/isAssign',
    }),
  },
  methods: {
    ...mapActions({
      searchValue: 'todos/SEARCH',
      //  getMembers: 'todos/getAllMembers'
    }),
    toggleModal() {
      this.isModal = !this.isModal;
    },

    isMobile() {
      if (
        /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
      ) {
        return true;
      }
      return false;
    },
    showComment() {
      this.isComment = true;
    },
    hideComment() {
      this.isComment = false;
    },
    searchTodo(val) {
      this.searchValue(val);
    },
    check() {
      if (this.$route.params.id) {
        this.showComment();
      } else {
        this.hideComment();
      }
    },
  },
  components: {
    // TodoCard,
    // CreateTodoBtn,
    // SearchInput,
    TodoForm,
    MainNav,
  },
  mounted() {
    // this.centrifuge = new Centrifuge('wss://realtime.zuri.chat/connection/websocket');
    // this.centrifuge.connect();
    // this.centrifuge.subscribe('Didier', function(messageCtx) {
    //     console.log(messageCtx);
    // })
    //  this.getMembers(this.isUser.currentWorkspace)
  },
};
</script>
