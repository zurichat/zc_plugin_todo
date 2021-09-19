<template>
<div>

                    <template v-if="showAll">
                        <div v-if="trash.length <= 0">
                            <Empty :title="'All Trash in tasks will be deleted after 7 days'" :subtitle="'No Tasks in Trash'"/>
                        </div>
                        <div v-else
                            class="
                                 todo_container
 sm:grid sm:grid-cols-2
gap-4
 md:grid-cols-3
 lg:grid-cols-4 
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
                        <div
                            class="
                                todo_container
                                sm:grid sm:grid-cols-2
                                gap-4
                                md:grid-cols-3
                            "
                        >
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
import Empty from '../components/Empty.vue'
import TodoCard from '../components/TodoCard.vue'
import {mapGetters} from 'vuex'
export default {
  name: "Trash",
  components : {
    Empty,
    TodoCard
  },
  computed: {
    ...mapGetters({
      trash: 'todos/allTrash',
      searchedTodo: 'todos/searchedTodo',
      showAll: 'todos/showAll'
    })
  }
};
</script>

