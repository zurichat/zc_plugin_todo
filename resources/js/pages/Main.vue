<template>
  <div>
    <!-- <h3>
            This is where we will be working
        </h3> -->
        <div id="header">
            <div id="logo " class="flex items-center flex-row">
                <img class="w-8 m-4" :src="'./img/zuri-logo.svg'" />
                <span class="font-bold text-lg">Zuri</span>
            </div>
        </div>
        <!-- <AddTaskForm /> -->
        <transition name='fade'>
            <TaskForm v-if="isModal"  @toggleModal = 'toggleModal' @createTask = "createTask"/>
            </transition>
        
        <AddTaskBtn @click="toggleModal" />
        
        <SearchInput @searchTodo = 'searchTodo'/>

    <TodoNav />
    <div class="todo_container sm:grid sm:grid-cols-2 gap-4 md:grid-cols-3">
      <taskCard
        v-for="(todo, index) in allTodos"
        :key="index"
        :title="todo.title"
        :date="todo.startDate"
        :description="todo.Description"
      />
    </div>
  </div>
</template>
<script>
import SearchInput from "../components/Search-Input.vue";
import taskCard from "../components/taskCard.vue";
import TodoNav from "../components/TodoNav.vue";
import AddTaskForm from "../components/addTaskForm.vue";
import AddTaskBtn from "../components/AddTaskBtn.vue";
import TaskForm from "../components/TaskForm";
import {mapGetters} from 'vuex'
export default {
    name: "Main",
    data(){
        return {
            isModal : false,
            
            searchTodos: [],
        }
    },
    methods: {
        toggleModal(){
            console.log('hi')
            this.isModal = !this.isModal
        },
        createTask(val){
          console.log(val);
          
          //this.allTodos = ;
          
        },
        searchTodo(val){
          this.seaarchTodos = this.allTodos.filter( todo => todo.title.toLowerCase().indexOf(val.toLowerCase()) >= 0)
        }
},
computed: {
   ...mapGetters({
       allTodos: 'todos/allTodos'
    })
},
    components: {
        taskCard,
        SearchInput,
        TodoNav,
        AddTaskBtn,
        AddTaskForm,
        TaskForm,
    },
};
</script>
