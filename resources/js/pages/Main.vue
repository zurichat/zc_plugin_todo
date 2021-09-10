<template>
    <div
        id="main_view"
        class="section_grid"
    >
        <div>
            <template v-if="showAll">
                <div v-if="allTodos.length <= 0">
                    <Empty
                        :title="'Oops Your Todo Store is Empty'"
                        :subtitle="'Click Create Task Button'"
                    />
                </div>
                <div
                    v-else
                    class="
                         todo_container
 sm:grid sm:grid-cols-2
gap-4
 md:grid-cols-3
 lg:grid-cols-4 
                    "
                >
                    <TodoCard
                        v-for="(todo, index) in allTodos"
                        :key="index++"
                        :todo="todo"
                    />
        </div>
        </template>
        <template v-else>
            <div class="
                        todo_container
                        sm:grid sm:grid-cols-2
                        gap-4
                        md:grid-cols-3
                        lg:grid-cols-4
                    ">
                <TodoCard
                    v-for="(todo, index) in result"
                    :key="index"
                    :todo="todo"
                />
            </div>
        </template>
        </div>
        </div>
</template>
<script>
import Empty from "../components/Empty.vue";
import TodoCard from "../components/TodoCard.vue";
import { mapGetters } from "vuex";

export default {
  name: "Main",
  data() {
    return {};
  },
  computed: {
    ...mapGetters({
      allTodos: "todos/allTodos",
      result: "todos/searchedTodo",
      showAll: "todos/showAll",
    }),
  },
  methods: {},
  components: {
    TodoCard,
    Empty,
  },
};
</script>
<style lang="scss"></style>
