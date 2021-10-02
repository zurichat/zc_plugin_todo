<template>
    <div id="main_view" class="section_grid td-p-2" >
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
                        md:td-grid-cols-2
                        lg:td-grid-cols-3 
                                            "
                      >
                     
                            <TodoCard
                                v-for="(todo, index) in allTodos"
                                :key="index"
                                :todo="todo"
                            />
                </div>
            </template>
            <template v-else>
              <div class="
                            todo_container
                            sm:td-grid sm:td-grid-cols-2
                            td-gap-4
                            md:td-grid-cols-2
                            lg:td-grid-cols-3
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
import TodoCard from "../components/NewCard.vue";
import { mapGetters } from "vuex";
import { mapActions } from "vuex";
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
  methods: {
       ...mapActions({getAllTodos: "todos/getAllTodos"}),
       
  },
  components: {
    TodoCard,
    Empty,
  },
  mounted() {
    console.log(this.user)
    // this.getAllTodos();
  }
};
</script>
<style lang="scss"></style>
