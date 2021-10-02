<template>
  <div>
    <template v-if="showAll">
      <div v-if="archivedTodos.length <= 0">
        <Empty
          
          :subtitle="'todo'"
        />
      </div>
      <div
        v-else
       id="todo_container" 
        class="
          sm:td-grid sm:td-grid-cols-2
          td-gap-4
          md:td-grid-cols-3
          lg:td-grid-cols-4
        "
      >
        <TodoCard
          v-for="(todo, index) in archivedTodos"
          :key="index++"
          :todo="todo"
        />
  </div>
  </template>
  <template v-else>
    <div id="searched_container" class="todo_container sm:td-grid sm:td-grid-cols-2 td-gap-4 md:td-grid-cols-3">
      <TodoCard
        v-for="(todo, index) in searchedTodo"
        :key="index"
        :todo="todo"
      />
    </div>
  </template>
  </div>
  <!-- <div class="archive">
    <p>Your Archived Tasks will be added here</p>
    <div class="image">
      <img src="/img/BigTrash.svg" />
      <span>No Tasks in Archive</span>
    </div>
  </div> -->
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Empty from "../components/Empty.vue";
import TodoCard from "../components/TodoCard.vue";
export default {
  name: "Archive",
  components: {
    Empty,
    TodoCard,
  },
  mounted() {
    this.getAllArchivedTodos();
  },
  computed: {
    ...mapGetters({
      archivedTodos: "todos/allArchive",
      // result: "todos/searchedTodo",
      showAll: "todos/showAll",
    }),
  },

  methods: {
    ...mapActions({ getAllArchivedTodos: "todos/getAllArchivedTodos" }),
  },
};
</script>

<style scoped></style>
