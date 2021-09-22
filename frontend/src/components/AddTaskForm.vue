<template>
    <!--<div>
        <form>

            <div class="input_box">
                <label for="topic">Topic</label>
                <input id="topic" name="topic" type="text">
            </div>
            <div class="input_box">
                <label for="description">Description</label>
                <input id="description" name="description" type="text">
            </div>
            <div class="input_box">
                <label for="label">Label</label>
                <input id="label" name="label" type="text">
            </div>
            <div class="input_box grid grid-cols-2">
                <div class="mini_input_box">
                    <label for="start">Start</label>
                   <input id="start" name="start" type="text">
                </div>
                <div class="mini_input_box">
                    <label for="name">Name</label>
                   <input id="name" name="name" type="text">
                </div>
            </div>
            <div class="action_buttons">
                <button>Cancel</button>
                <button>Add Task</button>
            </div>
        </form>
    </div>-->
    <div class="overlay">
    <form @submit.prevent="addTodo" class="td-4/5 td-md:w-6/12 td-p-4 td-bg-white td-rounded ">
      <div class="td-mb-4 ">
        <div class="td-flex td-flex-row td-justify-between td-pb-4 td-items-center">
            <h1 class="td-font-bold td-text-xl td-capitalize">Create a New Task</h1>
            <div @click="closeModal" class="td-cursor-pointer"><i class="pi pi-times"></i></div>
        </div>
        <h4 class="td-text-gray-400 td-text-sm td-font-medium">Task help you keep track of your work. They are associated with your created Todo</h4>
      </div>


      <div class="form-group td-flex td-flex-col pb-4">
        <label class="td-pb-2 td-font-bold" for="name">Title</label>
        <input v-model='title' required type="text" id="name"
          class="td-border hover:td-border-green-400 td-bg-white td-py-3 td-outline-none td-text-md td-w-full td-px-2 td-rounded" placeholder="name of your task" />
      </div>
      <!--
      <div class="form-group td-flex td-flex-col td-pb-4">
        <label class="td-pb-2 td-font-bold" for="description">Description<span>(optional)</span></label>
        <input v-model="desc" required type="text" id="description"
          class="td-border hover:td-border-green-400 td-bg-white td-py-3 td-outline-none td-text-md td-w-full td-px-2 td-rounded" placeholder="Type task description" />
      </div>
    
       <div class="form-group td-flex td-flex-col td-pb-4">
          <label class="td-pb-2 td-font-bold" for="dueDate">Due Date</label>
          <input required type="date" class="border hover:td-border-green-400 td-bg-white td-outline-none text-gray-500 td-py-3 td-text-md td-w-full td-px-2 td-rounded" id="dueDate"
            v-model="todoDetails.dueDate" />
        </div> --><br>
      <div class="cta-container">
        
        <button class="submit td-bg-green-500 td-py-3 td-px-4 td-rounded td-text-white td-font-bold" type="submit">Create Task</button>
      </div>
    </form>
  </div>
</template>
<script>
import axios from 'axios';
export default {
    name: 'AddTaskForm',
    data() {
      return {
         
          title:"",
          id:"",
         
         
        
      };
    },
    methods:{
        closeModal() {
       
        this.$emit("toggleModal");
      },
      addTodo(){

         
          //let res = await axios.put('https://todo.zuri.chat/api/v1/add/61490fc9e4b2aebf8ec8cf14', { hello: 'world' });
            let res = axios.put('https://todo.zuri.chat/api/v1/add/'+this.id, { tasks: this.title })
            .then((response) =>{
                console.log('welcome')
            })
            .catch((error) => {
                console.log(error);
            })
           
          this.$emit("toggleModal");
      }
    },
     mounted(){
     this.id = this.$route.params.id;
    
    }
}
</script>
<style lang="scss" scoped>
//   * {
//     margin: 0;
//     box-sizing: border-box;
//   }

   .overlay {
     width: 100%;
     display: flex;
     justify-content: center;
     align-items: center;
     position: fixed;
     top: 0;
     bottom: 0;
     left: 0;
     z-index: 2;
   }
.overlay {
      background: rgba(0, 0, 0, 0.14901960784313725);
    }
  
</style>