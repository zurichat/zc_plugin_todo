<template>
    <div class="p-5 mx-auto my-4 taskcard sm:mx-0 relative">
        <Modal
            v-show="isModalVisible"
            @close="closeModal"
        />
        <div class="flex justify-between pb-4">
            <div class="">
                <h1 class="task_title">{{todo.title}}</h1>
                <h1 class="task_description">{{todo.description}}</h1>
            </div>
            <div class="">
                <button
                    type="button"
                    class="btn"
                    @click="showModal"
                >
                    </button>

            </div>
        </div>
        <span class="flex">
            <a
                href="#"
                class="pl-1 link_color"
            >{{todo.date}}</a>
        </span>
        <div class="line"></div>
        <div class="">
            <h1 class="collab">COLLABORATORS</h1>
            <div class="flex justify-between">
                <div class="flex">

                    <div class="pl-1 female">

                    </div>
                </div>
                <span class="">
                    <span
                        @click="details(todo.card_id)"
                        class="gray_link"
                    >View task</span>
                </span>
            </div>
        </div>
    </div>
</template>
<script>
import Modal from "./Modal.vue";

export default {
  name: "todo",
  data(){
      return {
          isModalVisible: false,
      }
  },
  methods: {
    details(any) {
      
      this.$emit('showComment')
      this.$router.push({name: 'Details', params: { id: this.todo.card_id }})
    },
    showModal() {
      this.isModalVisible = true;
    },
    closeModal() {
      this.isModalVisible = false;
    },

  },
  components: {
      Modal
  },
  props: {
    todo: {
      type: Object,
    },
  },
};
</script>
<style lang="scss" scoped>
.todo_item {
  min-height: 10rem;
}

.taskcard {
  background: #ffffff;
  border: 1px solid #dadada;
  box-sizing: border-box;
  border-radius: 4px;
  max-width: 30em;
}

.task_title {
  color: #101010;
  font-size: 1.26rem;
  font-weight: bold;
}

.task_description {
  color: #959595;
  font-size: 13px;
}

.link_color {
  color: #1a61db;
  font-size: 1rem;
  font-weight: 700;
}

.line {
  background-color: #dadada;
  width: 100%;
  height: 1px;
  margin-top: 1rem;
  margin-bottom: 4px;
}

.collab {
  font-style: normal;
  font-weight: normal;
  font-size: 11px;
  line-height: 13px;
  letter-spacing: 0.1em;
  color: rgba(0, 0, 0, 0.6);
  margin-top: 8px;
  margin-bottom: 12px;
}

.gray_link {
  color: #7c7c7c;
  text-decoration-line: underline;
}
</style>
