<template>
	<div class="overlay">
		<form @submit.prevent="saveReminder(custom_data)" v-click-away="ClickAway" style="background:white"
			class="td-w-4/5 md:td-w-2/5 td-h-4/5 md:td-h-3/5 xl:td-h-4/5 td-flex td-flex-col td-justify-center td-sm:w-6/12 td-p-4 td-bg-white td-rounded ">

			<div class="td-mb-4 ">
				<div class="td-flex td-flex-row td-w-full td-justify-between td-pb-1">
					<h1 class="td-font-bold td-text-xl td-capitalize">Reminder</h1>
					<div @click="closeModal" class="td-cursor-pointer"><i class="pi pi-times"></i></div>
				</div>
				<h4 class="td-text-gray-400 td-text-sm td-font-medium">West Central Africa</h4>
			</div>
			<div class="td-form-group td-flex td-flex-col td-py-4">
				<label class="td-pb-2 td-font-bold" for="dueDate">Due Date</label>
				<input required type="date" v-model="custom_data.date"
					class="td-border td-border-gray-400 hover:td-border-green-400 td-bg-white td-outline-none text-gray-500 td-py-3 td-text-md td-w-full td-px-2 td-rounded" />
			</div>
			<div class="td-form-group td-flex td-flex-col td-py-4">
				<label class="td-pb-2 td-font-bold" for="dueDate">Time</label>
				<input required type="time" v-model="custom_data.time"
					class="td-border td-time td-border-gray-400 hover:td-border-green-400 td-bg-white td-outline-none text-gray-500 td-py-3 td-text-md td-w-full td-px-2 td-rounded" />
			</div>
			<div class="td-form-group td-flex td-flex-col td-py-4">
				<label class="td-pb-2 td-font-bold" for="dueDate">Add Note</label>
				<textarea v-model="custom_data.note" class="td-border
				td-border-gray-400 hover:td-border-green-400
				td-bg-white td-outline-none text-gray-500 td-py-3
				td-text-md td-w-full td-px-2 td-rounded" name="" id="" cols="20" rows="3"></textarea>
			</div>
			<div class="td-flex td-justify-end">
				<button type="submit"
					class="td-bg-green-400 td-text-white td-text-sm td-my-4 td-font-medium td-rounded td-px-4 td-py-2 td-w-40">
					Add Reminder
				</button>
			</div>
		</form>
	</div>
</template>

<script>
import axios from 'axios';
import { mapGetters } from 'vuex';

export default {
  name: 'cusReminderForm',
  data() {
    return {
      custom_data: {},
    };
  },
  computed: {
    ...mapGetters({
      selectedTodo: 'todos/selectedTodo',
      isUser: 'todos/user',
    }),
  },
  methods: {
    closeDelete() {
      console.log('hgey');
      this.$emit('toggleDeleteModal');
    },
    ClickAway() {
      this.$emit('cusReminderForm');
    },
    closeModal() {
      this.$emit('cusReminderForm');
    },
    deleteItem() {
      this.$emit('toggleDeleteModal');
      //   function to call action in the vuex store
      this.deleteTodo(this.id);
    },
    saveReminder(custom_data) {
      console.log(custom_data);
      alert('You have set a custom reminder');
      // http://localhost:8087/api/v1/todo/61411b096173056af01b4d01/task/6149c045738a3/add-reminder?organisation_id=613a3ac959842c7444fb0240&user_id=6139a43559842c7444fb01ef
      // console.log(custom_data)
      // axios.put(`https://todo.zuri.chat/api/v1/todo/${this.$route.params.id}/task/${this.task.task_id}/add-reminder?organisation_id=${this.isUser[0].org_id}&user_id=${this.isUser[0]._id}`, custom_data).then((response)=>{
      axios.put(`https://todo.zuri.chat/api/v1/todo/${this.$route.params.id}/task/${this.task.task_id}/add-reminder?organisation_id=${this.isUser[0].org_id}&${custom_data}&user_id=${this.isUser[0]._id}`).then((response) => {
        console.log(response);
      }).cath((error) => {
        console.log(error);
      });
      this.$emit('cusReminderForm');
    },
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
</style>
