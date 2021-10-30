<template>
    <div>
        <template v-if="showAll">
            <div v-if="trash.length <= 0">
                <Empty
                    :title="'All Trash in tasks will be deleted after 7 days'"
                    :subtitle="'No Tasks in Trash'"
                />
            </div>
            <div
                v-else
                class="
                                 todo_container
                                sm:td-grid sm:td-grid-cols-2
                                td-gap-4
                                md:td-grid-cols-3
                                lg:td-grid-cols-4
                            "
            >
                <TodoCard
                    v-for="(todo, index) in trash"
                    :key="index++"
                    :todo="todo"
                />
    </div>
    </template>
    <template v-else>
        <div class="
                                todo_container
                                sm:td-grid sm:td-grid-cols-2
                                td-gap-4
                                md:td-grid-cols-3
                            ">
            <TodoCard
                v-for="(todo, index) in searchedTodo"
                :key="index"
                :todo="todo"
            />
        </div>
    </template>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Empty from '../components/Empty.vue';
import TodoCard from '../components/todo_components/TodoCard.vue';

export default {
  name: 'Trash',
  components: {
    Empty,
    TodoCard,
  },
  computed: {
    ...mapGetters({
      trash: 'todos/allTrash',
      searchedTodo: 'todos/searchedTodo',
      showAll: 'todos/showAll',
    }),
  },
};
</script>
