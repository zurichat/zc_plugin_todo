<template>
	<div class="td-modal td-shadow-sm">
		<div class="
        td-grid
        td-overflow-visible
        td-border
        td-text-sm
        td-rounded-md
        td-shadow-sm
        td-modal-items
        td-w-64
        td-bg-white
        td-grid-row-5
      ">
			<div class="td-flex td-flex-col td-mb-0 items">
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
          ">Edit</span>
		<span @click="reminder" class="
				td-rounded-sm
				td-px-4
				td-text-gray-900
				td-font-normal
				td-text-sm
				td-cursor-pointer
				hover:td-text-white
				td-flex
				td-justify-between
				td-border-b
				td-py-3
				hover:td-bg-green-400
				hover:td-text-white">Reminder <i v-show="!isReminder" class="pi pi-angle-right td-self-end"></i></span>
				<span class="
            td-rounded-sm
            td-py-3
            td-px-4
            td-text-gray-900
            td-font-normal
            td-text-sm
            td-cursor-pointer
            hover:td-bg-red-500
            hover:td-text-white
          " @click="toggleDelete">Delete</span>
			</div>
		</div>
		<reminderModal :task="task" :todo="todo" v-show="isReminder" @reminder="reminder" @toggleReminderModal="toggleReminderModal" @toggleMenu="toggleMenu" />

	</div>
</template>

<script>

import reminderModal from '../reminderModal';

export default {
  name: 'td-modal',
  data() {
    return {

      isReminder: false,
    };
  },
  methods: {
    toggleDelete() {
      // this.isDeleteModal = !this.isDeleteModal;
      this.$emit('toggleDeleteModal');
    },

    reminder() {
      this.isReminder = !this.isReminder;
    },
  },
  mounted() {

  },
  props: {
    task: {
      type: Object,
    },
    todo: {
      type: Object,
    },
  },
  components: {

    reminderModal,
  },
};
</script>

<style scoped>
	.td-modal-items {
		position: absolute;
		top: 10px;
		right: 5px;
		z-index: 100;
		overflow: auto;
		overflow-y: auto;
		/* background-color: white; */
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
