<template>
  <div id="main_view" class="section_grid td-p-2">
    <div>
      <template v-if="showAll">
        <div v-if="allTodos.length <= 0">
          <Empty
             :subtitle="'todo'"
          />
        </div>
        <div
          class="
            todo_container
            sm:td-grid sm:td-grid-cols-2
            td-gap-4
            md:td-grid-cols-3
            lg:td-grid-cols-4
          "
        >
          <TodoCard
            v-for="(todo, index) in allTodos"
            :key="index"
            :todo="todo"
            @archived="handleArchivedTodo(todo)"
          />
        </div>
      </template>
      <template v-else>
        <div
          class="
            todo_container
            sm:td-grid sm:td-grid-cols-2
            td-gap-4
            md:td-grid-cols-3
            lg:td-grid-cols-4
          "
        >
          <TodoCard
            v-for="(todo, index) in result"
            :key="index"
            :todo="todo"
            @archived="handleArchivedTodo(todo)"
          />
        </div>
      </template>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';
import Empty from '../components/Empty.vue';
import TodoCard from '../components/todo_components/TodoCard.vue';

export default {
  name: 'Main',
  data() {
    return {};
  },
  computed: {
    ...mapGetters({
      allTodos: 'todos/allTodos',
      result: 'todos/searchedTodo',
      user: 'todos/user',
      showAll: 'todos/showAll',
    }),
  },
  methods: {
    ...mapActions({ getAllTodos: 'todos/getAllTodos' }),
    handleArchivedTodo(todo) {
      const todos = this.allTodos.filter((item) => item !== todo);

      this.$store.commit('todos/SET_TODOS', todos);
    },
  },
  components: {
    TodoCard,
    Empty,
  },
  mounted() {
    console.log(this.user);
    // this.getAllTodos();
  },
};
</script>
<style lang="scss"></style>
