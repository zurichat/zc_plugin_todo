<template>
<div>

                    <template v-if="showAll">
                        <div v-if="trash.length <= 0">
                            <Empty :title="'All Trash in tasks will be deleted after 7 days'" :subtitle="'No Tasks in Trash'"/>
                        </div>
                        <div v-else
                            class="
                                 todo_container
 sm:td-grid sm:td-grid-cols-2
td-gap-4
 md:td-grid-cols-3
 lg:td-grid-cols-4 
                            "
                        >                            
<Newcard
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
                                sm:td-grid sm:td-grid-cols-2
                                td-gap-4
                                md:td-grid-cols-3
                            "
                        >
                            <Newcard
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
import Newcard from '../components/Newcard.vue'
import {mapGetters} from 'vuex'
export default {
  name: "Trash",
  components : {
    Empty,
    Newcard
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

