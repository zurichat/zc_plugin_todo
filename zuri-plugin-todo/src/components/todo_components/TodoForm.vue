<template>
    <div class="overlay">
      <form @submit.prevent="addTodo" v-click-away="ClickAway" class="td-4/5 td-md:w-6/12 td-p-4 td-bg-white td-rounded ">
        <div class="td-mb-4 ">
          <div class="td-flex td-flex-row td-justify-between td-pb-4 td-items-center">
            <h1 class="td-font-bold td-text-xl td-capitalize">Create a new task</h1>
            <div @click="closeModal" class="td-cursor-pointer"><i class="pi pi-times"></i></div>
          </div>
          <h4 class="td-text-gray-400 td-text-sm td-font-medium">Todos help you keep track of tasks. They are best when
            created specifically for a task with subsequent sub tasks</h4>
        </div>

        <div class="form-group td-flex td-flex-col pb-4">
          <label class="td-pb-2 td-font-bold" for="name">Name</label>
          <input v-model='todoDetails.title' required type="text" id="name"
            class="td-border hover:td-border-green-400 td-bg-white td-py-3 td-outline-none td-text-md td-w-full td-px-2 td-rounded"
            placeholder="e.g. title" />
        </div>

        <div class="form-group td-flex td-flex-col td-pb-4">
          <label class="td-pb-2 td-font-bold" for="description">Description<span>(optional)</span></label>
          <input v-model="todoDetails.description" required type="text" id="description"
            class="td-border hover:td-border-green-400 td-bg-white td-py-3 td-outline-none td-text-md td-w-full td-px-2 td-rounded"
            placeholder="Type task description" />
        </div>

        <!-- <div class="form-group td-flex td-flex-col td-pb-4">
          <div class="overlay">
              <form
                  @submit.prevent="addTodo"
                  v-click-away="ClickAway"
                  class="td-4/5 td-md:w-6/12 td-p-4 td-bg-white td-rounded "
              >
                  <div class="td-mb-4 ">
                      <div
                          class="td-flex td-flex-row td-justify-between td-pb-4 td-items-center"
                      >
                          <h1 class="td-font-bold td-text-xl td-capitalize">
                              Create a new todo
                          </h1>
                          <div @click="closeModal" class="td-cursor-pointer">
                              <i class="pi pi-times"></i>
                          </div>
                      </div>
                      <h4 class="td-text-gray-400 td-text-sm td-font-medium">
                          Todos help you keep track of tasks. They are best when
                          created specifically for a task with subsequent sub tasks
                      </h4>
                  </div>

                  <div class="form-group td-flex td-flex-col pb-4">
                      <label class="td-pb-2 td-font-bold" for="name">Name</label>
                      <input
                          v-model="todoDetails.title"
                          required
                          type="text"
                          id="name"
                          class="td-border hover:td-border-green-400 td-bg-white td-py-3 td-outline-none td-text-md td-w-full td-px-2 td-rounded"
                          placeholder="e.g. title"
                      />
                  </div>

                  <div class="form-group td-flex td-flex-col td-pb-4">
                      <label class="td-pb-2 td-font-bold" for="description"
                          >Description<span>(optional)</span></label
                      >
                      <input
                          v-model="todoDetails.description"
                          required
                          type="text"
                          id="description"
                          class="td-border hover:td-border-green-400 td-bg-white td-py-3 td-outline-none td-text-md td-w-full td-px-2 td-rounded"
                          placeholder="Type task description"
                      />
                  </div>
                -->
        <!-- <div class="form-group td-flex td-flex-col td-pb-4">
                <label class="td-pb-2 td-font-bold" for="dueDate">Due Date</label>
                <input required type="date" class="border hover:td-border-green-400 td-bg-white td-outline-none text-gray-500 td-py-3 td-text-md td-w-full td-px-2 td-rounded" id="dueDate"
                  v-model="todoDetails.dueDate" />
              </div> -->
        <div class="cta-container">

          <button class="submit td-bg-green-500 td-py-3 td-px-4 td-rounded td-text-white td-font-bold td-float-right"
            type="submit">Create task</button>
        </div>
      </form>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

// import axios from "axios";
export default {
  name: 'TodoForm',
  data() {
    return {

      todoDetails: {
        title: '',
        type: 'public',
        description: '',
        labels: [],
        user_id: '',
      },
    };
  },
  computed: {
    // function to get user object from vuex store
    ...mapGetters({
      isUser: 'todos/user',
    }),
  },
  methods: {
    ...mapActions({
      createTodo: 'todos/HandleCreateTodo',
    }),
    closeModal() {
      this.$emit('toggleModal');
    },
    ClickAway() {
      this.$emit('toggleModal');
    },
    async addTodo() {
      this.todoDetails.user_id = this.isUser['0']._id;
      const data = this.todoDetails;
      this.createTodo(data);
      // await axios.post(`/create-todo?organisation_id=${org_id}`, data)
      //     .then((response) => console.log('todo created ' + response))
      //     .catch((error) => {
      //         if (error.response) {
      //             // The request was made and the server responded with a status code
      //             // that falls out of the range of 2xx
      //             console.warn(error.response.data);

      //         } else if (error.request) {
      //             // The request was made but no response was received
      //             console.log(error.request);
      //         } else {
      //             // Something happened in setting up the request that triggered the Error
      //             console.log('Error', error.message);
      //         }
      //         console.log(error.config)
      //     })
      this.$emit('toggleModal');
    },
  },
};
</script>

<style lang="scss" scoped>
//  * {
//      margin: 0;
//      box-sizing: border-box;
//    }

.overlay {
    line-height: 1.46666667;
    align-items: center;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    height: 100%;
    justify-content: center;
    left: 0;
    // opacity: 0;
    position: fixed;
    top: 0;
    transition: 80ms linear;
    width: 100%;
    z-index: 1012;
}
form {
    width: 40%;
    margin: 25px auto;
    background: #fff;
    border-radius: 8px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    font-size: 0.8rem;
    font-weight: 600;
    display: block;
    margin-bottom: 10px;
  }

  .form-group input,
  .form-group select {
    border: 1px solid #dadada;
    border-radius: 4px;
    background: #fff;
    width: 100%;
    padding: 12px 15px;
  }

  .form-flex {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
  }

  .form-flex .form-group {
    width: 48.5%;
    margin-bottom: 0;
  }

  .option {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
  }

  .option input {
    width: 20px;
    height: 20px;
    margin-right: 10px;
    cursor: pointer;
  }

  .option p {
    font-size: 0.85rem;
  }

  .cta-container {
    display: flex;
    justify-content: flex-end;
  }

  .cta-container button {
    border: 0;
    outline: 0;
    background: transparent;
    cursor: pointer;
  }

  .cta-container button.cancel {
    color: #00b87c;
    font-size: 0.75rem;
    margin-right: 30px;
  }

  .cta-container button.cancel:hover {
    color: #959595;
  }

  .cta-container button.submit {
    padding: 10px 20px;
    font-size: 0.75rem;
    background: #00b87c;
    color: #fff;
    border-radius: 4px;
    border: 1px solid transparent;
  }

  .cta-container button.submit:hover {
    border-color: #00b87c;
    background: transparent;
    color: #00b87c;
  }

</style>
