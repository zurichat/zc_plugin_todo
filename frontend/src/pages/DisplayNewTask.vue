<template>
  <div
    class="
      new_task_alert
      text-white
      align-middle`
      fixed
      px-1
      flex
      items-center
      justify-evenly
    "
  >
    New Task <span class="pl-3" >&#x2715;</span>
  </div>
  <div>
    <template v-if="showAll">
      <div>
      <div v-if="newTask.length <= 0">
        <Empty
          :title="'Oops No task has been added to this todo'"
          :subtitle="'Click (Add a new task) to create a task'"
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
        <TaskCard
          v-for="(task, index) in newTask"
          :key="index++"
          :task="task"
        />
      </div>
      </div>
    </template>
    <template v-else>
      <div class="todo_container sm:grid sm:grid-cols-2 gap-4 md:grid-cols-3">
        <TaskCard
          v-for="(task, index) in searchedTask"
          :key="index"
          :task="task"
        />
      </div>
    </template>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import Empty from "../components/Empty.vue";
import TaskCard from "../components/taskCard.vue";
export default {
  name: "DisplayNewTask",
  components: {
    Empty,
    TaskCard,
  },
  computed: {
    ...mapGetters({
      newTask: "todos/allArchive",
      searchedTask: "todos/searchedTodo",
      showAll: "todos/showAll",
    }),
  },
  methods: {
            hideModal() {
                this.$emit('hide');
            },
        },
};
</script>
<style lang="scss">
.new_task_alert {
  width: 9.875rem;
  height: 2.375rem;
  background: #00b87c;
  border-radius: 0.188rem;
  left: 44.51%;
  right: 44.51%;
  top: 21.29%;
  bottom: 75%;
}
</style>
