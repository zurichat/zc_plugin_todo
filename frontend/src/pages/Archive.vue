<template>
  <div>

    <template v-if="showAll">
      <div v-if="archive.length <= 0">
        <Empty
          :title="'Your Archived Tasks will be added here'"
          :subtitle="'No Tasks in Archive'"
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
          v-for="(todo, index) in archive"
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
                            ">
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
import { mapGetters } from "vuex";
import Empty from "../components/Empty.vue";
import TodoCard from '../components/TodoCard.vue'
export default {
  name: "Archive",
  components: {
    Empty,
    TodoCard
  },
  computed: {
    ...mapGetters({
      archive: "todos/allArchive",
      searchedTodo: "todos/searchedTodo",
      showAll: "todos/showAll"
    }),
  },
};
</script>

<style scoped>

</style>