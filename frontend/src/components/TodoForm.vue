<template>
  <div class="overlay">
    <form @submit.prevent="addTodo" class="w-4/5 md:w-6/12 p-4 bg-white rounded ">
      <div class="mb-4 ">
        <div class="flex flex-row justify-between pb-4 items-center">
            <h1 class="font-bold text-xl capitalize">Create a new task</h1>
            <div @click="closeModal" class="cursor-pointer"><i class="pi pi-times"></i></div>
        </div>
        <h4 class="text-gray-400 text-sm font-medium">Todos help you keep track of tasks. They are best when created specifically for a task with subsequent sub tasks</h4>
      </div>


      <div class="form-group flex flex-col pb-4">
        <label class="pb-2 font-bold" for="name">Name</label>
        <input v-model='todoDetails.title' required type="text" id="name"
          class="border hover:border-green-400 bg-white py-3 outline-none text-md w-full px-2 rounded" placeholder="e.g. title" />
      </div>

      <div class="form-group flex flex-col pb-4">
        <label class="pb-2 font-bold" for="description">Description<span>(optional)</span></label>
        <input v-model="todoDetails.description" required type="text" id="description"
          class="border hover:border-green-400 bg-white py-3 outline-none text-md w-full px-2 rounded" placeholder="Type task description" />
      </div>
    
        <!-- <div class="form-group flex flex-col pb-4">
          <label class="pb-2 font-bold" for="dueDate">Due Date</label>
          <input required type="date" class="border hover:border-green-400 bg-white outline-none text-gray-500 py-3 text-md w-full px-2 rounded" id="dueDate"
            v-model="todoDetails.dueDate" />
        </div> -->
      <div class="cta-container">
        
        <button class="submit bg-green-500 py-3 px-4 rounded text-white font-bold float-right" type="submit">Create task</button>
      </div>
    </form>
  </div>
</template>

<script>
  import { mapActions } from "vuex";
  import { mapGetters } from "vuex";
  import axios from 'axios'
  export default {
    name: "TaskForm",
    data() {
      return {
          token: '',
        todoDetails: {
          title: "",
          
          type: "public",
          description: "",
          labels: [],
          user_id: "",
        },
      };
    },
    computed: {
      //function to get user object from vuex store
      ...mapGetters({
        user: "user/user",
      }),
    },
    methods: {
      ...mapActions({
        createTodo: "todos/createTodo",
      }),
      closeModal() {
        console.log("hgey");
        this.$emit("toggleModal");
      },
      addTodo() {
          
          axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
        this.todoDetails.user_id = this.user.uuid;
        //console.log(this.todoDetails);
        //   function to toggle modal in the main page
        console.log(this.todoDetails)
        this.$emit("toggleModal");
        //   function to call action in the vuex store 
        this.createTodo(this.todoDetails);
      },
    },
  };
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

//   form {
//     width: 40%;
//     margin: 25px auto;
//     background: #fff;
//     border-radius: 8px;
//   }

//   .form-group {
//     margin-bottom: 20px;
//   }

//   .form-group label {
//     font-size: 0.8rem;
//     font-weight: 600;
//     display: block;
//     margin-bottom: 10px;
//   }

//   .form-group input,
//   .form-group select {
//     border: 1px solid #dadada;
//     border-radius: 4px;
//     background: #fff;
//     width: 100%;
//     padding: 12px 15px;
//   }

//   .form-flex {
//     display: flex;
//     justify-content: space-between;
//     margin-bottom: 20px;
//   }

//   .form-flex .form-group {
//     width: 48.5%;
//     margin-bottom: 0;
//   }

//   .option {
//     display: flex;
//     align-items: center;
//     margin-bottom: 25px;
//   }

//   .option input {
//     width: 20px;
//     height: 20px;
//     margin-right: 10px;
//     cursor: pointer;
//   }

//   .option p {
//     font-size: 0.85rem;
//   }

//   .cta-container {
//     display: flex;
//     justify-content: flex-end;
//   }

//   .cta-container button {
//     border: 0;
//     outline: 0;
//     background: transparent;
//     cursor: pointer;
//   }

//   .cta-container button.cancel {
//     color: #00b87c;
//     font-size: 0.75rem;
//     margin-right: 30px;
//   }

//   .cta-container button.cancel:hover {
//     color: #959595;
//   }

//   .cta-container button.submit {
//     padding: 10px 20px;
//     font-size: 0.75rem;
//     background: #00b87c;
//     color: #fff;
//     border-radius: 4px;
//     border: 1px solid transparent;
//   }

//   .cta-container button.submit:hover {
//     border-color: #00b87c;
//     background: transparent;
//     color: #00b87c;
//   }

  
.overlay {
      background: rgba(0, 0, 0, 0.14901960784313725);
    }
  
</style>