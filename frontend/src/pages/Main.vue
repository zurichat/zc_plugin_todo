<template>
    <div>
        <div class="td-py-4">
            <div class="td-flex-grow td-px-4">
                <SearchInput @searchTodo="searchTodo" />
                <div class="
                        td-flex td-flex-col
                        md:td-flex-row
                        td-flex-start
                        td-justify-start
                        md:td-items-center
                        md:td-justify-between
                    ">        
                    <MainNav @showLabel="showEditModal = true" />
                    <CreateTodoBtn @click="toggleModal" />
                </div>
            </div>
            <div class="td-px-1">
                <router-view />
            </div>

            
            <transition name="fade">
                <TodoForm
                    v-if="isModal"
                    @toggleModal="toggleModal"
                />
            </transition>
        </div>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";
import TodoForm from "../components/TodoForm";
import MainNav from "../components/MainNav";
import CreateTodoBtn from "../components/CreateTodoBtn";
import SearchInput from "../components/SearchInput";
// import TodoCard from "../components/TodoCard.vue";
export default {
  name: "New Main",
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
      allTodos: "todos/allTodos",
      isAssign: "todos/isAssign",
    }),
  },
  methods: {
    ...mapActions({
      searchValue: "todos/SEARCH",
    }),
    toggleModal() {
     
      this.isModal = !this.isModal;
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
    CreateTodoBtn,
    SearchInput,
    TodoForm,
    MainNav,
  },
  mounted() {
    // this.centrifuge = new Centrifuge('wss://realtime.zuri.chat/connection/websocket');
    // this.centrifuge.connect();
    // this.centrifuge.subscribe('Didier', function(messageCtx) {
    //     console.log(messageCtx);
    // })
  },
};
</script>
