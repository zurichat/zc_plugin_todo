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
            <TaskForm v-if="isModal"  @toggleModal = 'toggleModal'/>
            </transition>
        
        <AddTaskBtn @click="toggleModal" />
        
        <SearchInput @searchTodo = 'searchTodo'/>

    <TodoNav />
    <div id="main_view" class="section_grid">
      <template v-if="showAll">
          <div  class="todo_container  sm:grid sm:grid-cols-2 gap-4 md:grid-cols-3">
          <taskCard
            v-for="(todo, index) in allTodos"
        :key="index"
        :title="todo.title"
        :date="todo.startDate"
        :description="todo.description"
          />
        </div>
        </template>
        <template v-else>
          <div  class="todo_container  sm:grid sm:grid-cols-2 gap-4 md:grid-cols-3">
          <taskCard
            v-for="(todo, index) in searchedValues"
        :key="index"
        :title="todo.title"
        :date="todo.startDate"
        :description="todo.description"
          />
        </div></template>
        <div id="comment">
          <router-view />
        </div>
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
            showAll: true,
            searchedValues: []
        }
    },computed: {
   ...mapGetters({
       allTodos: 'todos/allTodos'
    })
},methods: {
        toggleModal(){
            console.log('hi')
            this.isModal = !this.isModal
        },
        searchTodo(val){
          if(val === '' ){
                this.showAll = true
            }
            else {
                this.showAll = false
          this.searchedValues = this.allTodos.filter( todo => todo.title.toLowerCase().indexOf(val.toLowerCase()) >= 0)
        }}
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
