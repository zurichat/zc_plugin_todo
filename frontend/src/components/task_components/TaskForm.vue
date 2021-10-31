<template>
    <div class="overlay">
        <form
            @submit.prevent="createTask"
            v-click-away="ClickAway"
            class="td-4/5 md:td-w-6/12 td-p-4 td-bg-white td-rounded "
        >
            <div class="td-mb-4 ">
                <div
                    class="td-flex td-flex-row td-justify-between td-pb-4 td-items-center"
                >
                    <h1 class="td-font-bold td-text-xl td-capitalize">
                        Create a new Task
                    </h1>
                    <div @click="closeModal" class="td-cursor-pointer">
                        <i class="pi pi-times"></i>
                    </div>
                </div>
                <!-- <h4 class="td-text-gray-400 td-text-sm td-font-medium">
                    Todos help you keep track of tasks. They are best when
                    created specifically for a task with subsequent sub tasks
                </h4> -->
            </div>

            <div class="form-group td-flex td-flex-col pb-4">
                <label class="td-pb-2 td-font-bold" for="name">Title</label>
                <input
                    v-model="form_data.title"
                    required
                    type="text"
                    id="name"
                    class="td-border hover:td-border-green-400 td-bg-white td-py-3 td-outline-none td-text-md td-w-full td-px-2 td-rounded"
                    placeholder="e.g. title"
                />
            </div>

             <div class="form-group td-flex td-flex-col td-pb-4">
                <label class="td-pb-2 td-font-bold" for="description"
                    >Recurring<span>(optional)</span></label
                >
                <div class="td-flex td-items-center"><span class="td-text-gray-500 td-px-2">Click to make task a recurring task: </span> <Checkbox id="binary" v-model="checked" :binary="true" @change="form_data.recurring == 0 ? form_data.recurring = 1 : form_data.recurring = 0 "  /></div>
            </div>

            <!-- <div class="form-group td-flex td-flex-col td-pb-4">
          <label class="td-pb-2 td-font-bold" for="dueDate">Due Date</label>
          <input required type="date" class="border hover:td-border-green-400 td-bg-white td-outline-none text-gray-500 td-py-3 td-text-md td-w-full td-px-2 td-rounded" id="dueDate"
            v-model="todoDetails.dueDate" />
        </div> -->
            <div class="cta-container">
                <button
                    class="submit td-bg-green-500 td-py-3 td-px-4 td-rounded td-text-white td-font-bold td-float-right"
                    type="submit"
                >
                    Create task
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

import Checkbox from 'primevue/checkbox';
// import axios from "axios";
export default {
  name: 'TaskForm',
  data() {
    return {
      checked: false,
      form_data: {
        title: '',
        recurring: 0,
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
  components: {
    Checkbox,
  },
  methods: {
    ...mapActions({
      createTodo: 'todos/createTodo',
    }),
    closeModal() {
      this.$emit('toggleModal');
    },
    ClickAway() {
      this.$emit('toggleModal');
    },
    createTask() {
      this.form_data.user_id = this.isUser['0']._id;
      this.$emit('createTask', this.form_data);
      this.$emit('toggleModal');
      // this.createTodo(this.todoDetails);
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
</style>
