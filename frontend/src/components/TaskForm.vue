<template>
  <div class="overlay">
    <form @submit.prevent="addTodo" class="sm:my-4 p-4 sm:p-6">
      <div class="flex flex-row justify-between mb-4 items-center">
        <h1 class="font-bold text-lg ">Create a new task</h1>
        <div @click="closeModal">X</div>
      </div>


      <div class="form-group">
        <label for="topic">Topic</label>
        <input v-model='todoDetails.title' required type="text" id="topic"
          class="border bg-white h-12 text-md w-full px-2 rounded" placeholder="Type task title" />
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <input v-model="todoDetails.description" required type="text" id="description"
          class="border bg-white h-12 text-md w-full px-2 rounded" placeholder="Type task description" />
      </div>

      <div class="form-group">
        <label for="label">Label</label>
        <select required name="label" class="border bg-white h-12 text-md w-full px-2 rounded"
          v-model="todoDetails.label" id="label">
          <option value disabled selected>Select task label</option>
          <option value="1">Sprint</option>
          <option value="2">Marathon</option>
          <option value="3">hng-esque task</option>
        </select>
      </div>

      <div class="form-flex">
        <div class="form-group">
          <label for="stateDate">Start</label>
          <input required type="date" class="border bg-white h-12 text-md w-full px-2 rounded" id="stateDate"
            v-model="todoDetails.startDate" />
        </div>

        <div class="form-group">
          <label for="endDate">End</label>
          <input class="border bg-white h-12 text-md w-full px-2 rounded" required type="date" id="endDate" />
        </div>
      </div>

      <div class="option">
        <input type="checkbox" />
        <p>Recurring task</p>
      </div>

      <div class="cta-container">
        <button class="cancel" type="button" @click="closeModal">Cancel</button>
        <button class="submit" type="submit">Create task</button>
      </div>
    </form>
  </div>
</template>

<script>
  import { mapActions } from "vuex";
  import { mapGetters } from "vuex";
  export default {
    name: "TaskForm",
    data() {
      return {
        todoDetails: {
          card_id: `${Date.now()}`,
          title: "",
          label: "",
          description: "",
          startDate: "",
          EndDate: "",
          userId: "",
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
        createTask: "todos/createTask",
      }),
      closeModal() {
        console.log("hgey");
        this.$emit("toggleModal");
      },
      addTodo() {
        this.todoDetails.userId = this.user.userId;
        //console.log(this.todoDetails);
        //   function to toggle modal in the main page
        this.$emit("toggleModal");
        //   function to call action in the vuex store 
        this.createTask(this.todoDetails);
      },
    },
  };
</script>

<style lang="scss" scoped>
  * {
    margin: 0;
    box-sizing: border-box;
  }

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

  @media screen and (min-width: 768px) {
    .overlay {
      background: rgba(0, 0, 0, 0.14901960784313725);
    }
  }


  @media screen and (max-width: 768px) {

    form {
      width: 100%;
      height: 100%;
      overflow-y: scroll;
    }
  }
</style>