<template>
<div class="td-w-full td-flex-grow ">
  <div id="Details" class="px-2">
    <div class="todo-nav td-bg-green-500 td-flex td-items-center">
      <h1 class="td-px-4 td-py-2 td-text-white td-text-3xl"># To-do-list</h1>
        
      <span class="btn"><i class="pi td-td- td-px-4 pi-chevron-down"/></span>
    </div>
    <div class="header td-py-4 td-flex td-justify-between td-items-center td-border-b-2">
      <div>
        <h2 class="td-text-xl td-font-bold td-text-green-500"><i class="pi pi-calendar td-px-2"></i>Todo 01- Create UI for a todo</h2>
      </div>
      <div class="td-flex td-flex-row td-items-center">
        <div class="todo-headerRight">
          <!-- <a class="commentIcon"><img src="/img/Rectangle 892.png" alt="reply"></a> -->
          <div class="todo-profileImg td-flex td-items-center">
            <div class="todo-profile profileOne">
              <img src="../assets/img/collaborators.svg" style="border: 1px solid rgb(1, 216, 146); border-radius: 4px;">
            </div>
            
            <p class="text-300">300</p>
          </div>
        </div>
        
        <div class="td-relative" v-click-away="ClickAway">
                  <span @click="assign()" class="td-bg-green-500 td-h-10 td-w-10 td-mx-2 td-justify-center td-flex td-items-center td-rounded-xl"><i class="pi td-text-white pi-user-plus td-cursor-pointer"/></span>
                  <div v-if="isAssign" class="user_dropdown td-absolute td-p-2 td-bg-white td-rounded td-shadow td-border td-mt-12 td-top-0 td-right-0">
                      <input @input="search()" v-model=value class="td-rounded td-border-green-300 td-mx-auto td-w-11/12 td-border td-py-2 td-px-2 hover:td-border-green-500 td-outline-none" type="text"/>
                      <div class="td-h-64 td-w-64 td-overflow-y-scroll">
                        <label @click="assign()" :for="user.name.first" v-for="(user, index) in users" :key="index" class="td-flex hover:td-border td-text-gray-500 hover:td-text-white hover:td-bg-green-500 td-border-b td-p-2 td-my-2 td-pb-2 td-items-center"> <span  class="tracking-wide td-px-2 td-font-bold">{{user.name.first + ' ' + user.name.last}}</span></label>
                      </div>
                  </div>
        </div>
      </div>
    </div>
    <div class="sub-header td-flex td-py-3 td-justify-between td-items-center td-border-b-2">
      <div class="td-flex"> 
        <div class="mr-2 font-bold button td-px-4 td-py-2 td-bg-green-500 td-cursor-pointer td-rounded td-text-white">+ Add a new Task</div>
      <div class="amt_completed td-px-4 td-py-2 td-flex td-items-center">
        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9999 1.82458H4.99988C4.17145 1.82458 3.49988 2.49616 3.49988 3.32459V15.3246C3.49988 16.153 4.17145 16.8246 4.99988 16.8246H13.9999C14.8283 16.8246 15.4999 16.153 15.4999 15.3246V6.32459L10.9999 1.82458Z" stroke="#242424" stroke-width="1.22693" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M10.9999 1.82458V6.32459H15.4999" stroke="#242424" stroke-width="1.22693" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M12.4999 10.0747H6.49988" stroke="#242424" stroke-width="1.22693" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M12.4999 13.0747H6.49988" stroke="#242424" stroke-width="1.22693" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M7.99988 7.07458H7.24988H6.49988" stroke="#242424" stroke-width="1.22693" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
<!-- 07060961923 -->
        <span class="td-font-bold ">{{ itemsTodo.length }}   completed</span>
      </div>
      </div>
        <div class="progress_container td-flex td-flex-col">
      <span class="progress_text td-self-end td-text-sm td-font-medium ">{{percent}}/100%</span>
      <progress id="progress" class="td-w-full td-mx-auto" :value="percent" max="100"> 32% </progress>
    </div>
    </div>
    <!-- <div class="py-2 description ">
      <span>Our todo plugin is a collection which means more than one todo can be made. Each todo can contain multiple tasks containing which includes: the title, the description, list of check able task. Note each todo is a room, when you create a todo you’ve automatically created a channel with the  same name (visible in the side bar) and everyone assigned to it will be in that channel. At the point of creating the todo you can decide to make it private or public </span>
    </div> -->
    
    <div class="tasks_container td-py-4">
      
      <div class="td-my-4 tabMenu">
        <span class="task_head td-font-bold td-mr-4 td-text-green-500"  @click="isSelect('1')">Pending</span>
        <span class="ml-8 task_head td-font-bold" @click="isSelect('2')" >Completed</span>
          
      <div class="tabContents">
      <div v-if="isActive === '1'">    

      
      <div v-for="(i, index) in alltasks" :key="index++" class="td-pl-4 td-m-4 task_box td-flex td-py-2 hover:shadow td-rounded hover:border">
       <Checkbox v-model="checked" :id="'city' + index++" name="city" :value="'Chicago' + index++" />
        <!--  <div class="task_content td-flex-grow td-pl-2">
           <div class="td-flex td-justify-between">
             <p class="task_title td-pb-3 td-font-medium"><span class="task_number">Task 0{{index++}} -</span> in the main todo, every intern must complete a task succesfully to go to stage 6</p>
              <div class="">
              <div @click="toggleMenu(index)"><i class="pi pi-ellipsis-v td-cursor-pointer"></i></div>
              </div>
              
            </div>  
          
          <div class="task_details td-flex td-flex-row td-justify-between">
            <div class="task_comment-amt td-flex td-items-center">
              <div class="todo-profileImg2 td-flex">
                <div class="todo-profile profileOne">
                  <img src="../assets/img/collaborators.svg" style="border: 1px solid rgb(1, 216, 146); border-radius: 4px;">
                </div>
                
              </div>
              <span class="td-pl-2 td-font-bold td-text-sm td-text-green-500">5 comments</span>
              <span class="td-pl-2 td-text-gray-500 td-text-sm">Last Comment 12 hours ago</span>
            </div>
            <div class="task_tag td-flex td-flex-row td-items-center">
              <div class="td-text-gray-500 td-pr-1"><i class="pi pi-tag"></i><span class="td-px-2 td-capitalize td-font-bold td-text-sm">General</span></div>
              <div class="td-text-gray-500 td-pr-1"><i class="pi pi-tag"></i><span class="td-px-2 td-capitalize td-font-bold td-text-sm">HNG</span></div>
              <div class="td-text-blue-500 td-pr-1"><i class="pi pi-calendar"></i><span class="td-px-2 td-font-bold td-text-sm">Tomorrow</span></div>
              <div></div>
            </div>
          </div>
        </div>   -->
      <task />
      </div>
    </div>
    
      <div v-else-if="isActive === '2'">
       {{ checked }}
        
      </div>
    </div>
  </div>
</div>
  </div>
  <!-- <div id="Comment" class="flex-shrink-0 w-1/4 border"></div> -->
    <!-- <div class="flex flex-row td-justify-between td-items-center"> 
      {{this.$route.params.id}}
      <div @click="close" class="font-bold text-green-500">X</div>
      </div>
      <p class="font-bold text-green-500 ">
        This is the todo details section,
        
      </p>
      <p class="text-lg font-bold text-red-500 text-wrap">Still under construction</p> -->
      <!-- <div>
        <div>
          <p>Task Title</p>
        <span>Created On: 12/03348n/39424</span>
        <p>oihsoiv hwt0pu;n4wy0iohjgwklef</p>
        </div>
        <div>
          <p>Task Title</p>
          <div>
            
          </div>
        </div>
        <div class="flex">
          <div>
            <p>Due Date</p>
            <span>p320409</span>
          </div>
          <div>
            <p>Worked </p>
            <span>loiwheot</span>
          </div>
        </div>
      </div> -->
      <!-- <TextArea /> -->
    </div>
   
</template>
<script>

import task from '../components/task'
import Checkbox from 'primevue/checkbox';
import axios from 'axios'
// import TextArea from '../components/TextArea.vue\
// import CommentBox from '../components/CommentBox.vue'
import {mapGetters} from 'vuex'
export default {
    name: 'TodoDetails',
    data(){
      return {
        isActive: '1',
        selectedTodo: '',
        checked: [],
        isAssign: false,
        alltasks: ['', '', '', '', '', '',],
        users: [],
        value: '',
      }
    },
        computed: {
      ...mapGetters({
        allTodos: 'todos/allTodos'
      }),
      
      percent(){
       return (this.checked.length / this.alltasks.length) * 100
      },
      
      itemsTodo() {
      return this.checked.filter(todo => !todo.completed)
    }

    },
    components: {
      
      Checkbox, 
      task
    },
  methods: {
    
      isSelect: function (num) {
      this.isActive = (num);
     },
  
    close(){
      this.$emit('hideComment')
    },
    ClickAway(){
      this.isAssign = false
    },
    assign(){
        this.isAssign = !this.isAssign
      },
    check(){
      let id = this.$route.params.id
      this.selectedTodo = this.allTodos.find( todo => todo.card_id.toLowerCase() === (id.toLowerCase()));
       if(this.selectedTodo <= 0 || this.selectedTodo === undefined){
         this.$emit('hideComment')
         this.$router.push({path: '/main'})
         
       }
       else {
         //
       }
      console.log(this.selectedTodo)
    },
    getUser(){
        axios.get('https://randomuser.me/api/?results=15').
        then(response => this.users = (response.data.results))
      },
  },
  mounted(){
      // this.check();
      this.getUser()
    }
}
</script>
<style lang="scss">
progress[value] {
  /* Reset the default appearance */
  -webkit-appearance: none;
   appearance: none;
  border-radius: .6em;
  height: 5px;
  //  box-shadow: 0 0 10px rgb(0 103 69 / 28%);
}
progress[value]::-webkit-progress-bar {
 
  border-radius: 2px;
  background-color: #E2ECF8;
}
progress[value]::-webkit-progress-value {
  background-color: #00B87C;
  border-radius: 2px;
}
#progress_container {
  min-width: 15em
  }
#progress{
  height: 1.1rem;
  border-radius: 4px;
}
.todo-profileImg {
    position: relative;
    background: #fff;
    border: 1px solid #F6F6F6;
    border-radius: 4px;
    width: 105px;
    height: 30px;
}
.todo-profileImg2{
  position: relative;
    background: #fff;
    border-radius: 4px;
    width: 105px;
    height: 30px;
}

.todo-profile.profileOne {
    left: 2%;
    z-index: 1000;
}
.todo-profile {
    position: absolute;
    border-radius: 4px;
    top: 7%;
}
.todo-profile.profileTwo {
    left: 19%;
    z-index: 500;
}
.todo-profile.profileThree {
    left: 35%;
}
.text-300 {
    position: absolute;
    top: 18%;
    right: 5%;
    font-size: 16px;
    font-weight: bold;
    z-index: 100;
    color: #000;
}
.tabMenu span {
  cursor: pointer;
}

</style>
