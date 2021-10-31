<template>
    <div class="td-modal td-shadow-md">
        <div class="
        td-grid
        td-overflow-visible
        td-border
        td-text-sm
        td-rounded-md
        td-shadow-md
        td-modal-items
        td-w-32
        td-bg-white
        td-grid-row-5
      ">
            <div class="td-flex td-flex-col td-mb-0 items">
                <div @click="closeModal"
                    class="td-p-2 td-cursor-pointer td-w-8 td-h-6 td-text-red-500 td-rounded-lg td-shadow-md td-flex"><i
                        class="pi pi-times"></i></div>
                <span @click='saveReminder("20 mins")' class="
            td-rounded-sm
            td-py-3
            td-px-4
            td-text-gray-900
            td-font-normal
            td-text-sm
            td-cursor-pointer
            td-border-b
            hover:td-bg-green-400
            hover:td-text-white
          ">In 20mins</span>
                <span @click='saveReminder("1 hour")' class="
					td-rounded-sm
					td-py-3
					td-px-4
					td-text-gray-900
					td-font-normal
					td-text-sm
					td-cursor-pointer
					td-border-b
					hover:td-bg-green-400
					hover:td-text-white
					">In 1 hour</span>
                <span @click='saveReminder("2 hours")' class="
						td-rounded-sm
						td-py-3
						td-px-4
						td-text-gray-900
						td-font-normal
						td-text-sm
						td-cursor-pointer
						td-border-b
						hover:td-bg-green-400
						hover:td-text-white
						">In 2 hours</span>
                <span @click='saveReminder("tomorrow 9am")' class="
						td-rounded-sm
						td-py-3
						td-px-4
						td-text-gray-900
						td-font-normal
						td-text-sm
						td-cursor-pointer
						td-border-b
						hover:td-bg-green-400
						hover:td-text-white
						">Tomorrow</span>
                <span @click='saveReminder("1 week 9am")' class="
						td-rounded-sm
						td-py-3
						td-px-4
						td-text-gray-900
						td-font-normal
						td-text-sm
						td-cursor-pointer
						td-border-b
						hover:td-bg-green-400
						hover:td-text-white
						">1 week</span>
                <span class="
								td-rounded-sm
								td-py-3
								td-px-4
								td-text-gray-900
								td-font-normal
								td-text-sm
								td-cursor-pointer
								td-border-b
								hover:td-bg-green-400
								hover:td-text-white
								td-flex
								td-justify-between
								" @click="cusReminder">Custom <i v-show="!isReminder" class="pi pi-angle-right td-self-end"></i></span>
            </div>
        </div>
        <transition name="fade">
            <cusReminderForm :task="task" :todo="todo" v-if="iscusReminder" @cusReminderForm="cusReminderForm" />
        </transition>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import axios from 'axios';
import cusReminderForm from './cusRemiderForm.vue';

export default {
  name: 'td-modal',
  data() {
    return {
      iscusReminder: false,

    };
  },
  computed: {
    ...mapGetters({
      selectedTodo: 'todos/selectedTodo',
      isUser: 'todos/user',
    }),
  },
  methods: {
    cusReminder() {
      this.iscusReminder = !this.iscusReminder;
      this.$emit('toggleMenu');
      this.$emit('cusReminderForm');
    },
    closeModal() {
      this.$emit('reminder');
    },
    cusReminderForm() {
      this.iscusReminder = !this.iscusReminder;
    },

    saveReminder(reminder_type) {
      alert(`You have set a reminder by ${reminder_type}`);

      const data = {
        time_string: reminder_type,
      };

      // axios.put(`https://todo.zuri.chat/api/v1/todo/${this.$route.params.id}/task/${this.task.task_id}/add-reminder?organisation_id=${this.isUser[0].org_id}&user_id=${this.isUser[0]._id}`, data).then((response)=>{
      axios.put(`https://todo.zuri.chat/api/v1/todo/${this.$route.params.id}/task/${this.task.task_id}/add-reminder?organisation_id=${this.isUser[0].org_id}&${data}&user_id=${this.isUser[0]._id}`).then((response) => {
        console.log(response);
      }).cath((error) => {
        console.log(error);
      });
    },
    // reminderForm(){
    // 	this.$emit("cusReminderForm")
    // }
  },
  props: {
    links: {
      type: Array,
    },
    todo: {
      type: Object,
    },
    task: {
      type: Object,
    },
  },
  components: {
    cusReminderForm,
  },
  mounted() {

  },
};
</script>

<style scoped>
    .td-modal-items {
        position: absolute;
        top: 100px;
        right: 10px;
        z-index: 100;
        overflow: auto;
        overflow-y: auto;
        /* background-color: white; */
    }

    @media screen and (max-width: 768px) {
        .td-modal-items {
            position: absolute;
            top: 150px;
            right: 0px;
            z-index: 100;
            overflow: auto;
            overflow-y: auto;
            /* background-color: white; */
        }
    }

    .btn-close {
        position: absolute;
        top: 20px;
        right: 0;
        z-index: 100;
        overflow: auto;
        overflow-y: auto;
        background-color: white;
    }

    .btn-close {
        position: absolute;
        top: 0;
        right: 0;
        border: none;
        font-size: 20px;
        padding: 10px;
        cursor: pointer;
        font-weight: bold;
        color: #4aae9b;
        background: transparent;
    }
</style>
