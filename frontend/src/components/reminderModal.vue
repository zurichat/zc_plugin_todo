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
          " >In 20mins</span>
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
					">In 1hour</span>
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
						">In 2hours</span>
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
						">Tomorrow</span>
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
						">In 1week</span>
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
								"
								@click="cusReminder">Custom</span>
			</div>
		</div>
		<transition name="fade">
			<cusReminderForm v-if="iscusReminder" :title="todo.title" :id="todo._id" @cusReminderForm="cusReminderForm" />
		</transition>
	</div>
</template>

<script>
	import cusReminderForm from './cusRemiderForm.vue'
	export default {
		name: "td-modal",
		data(){
			return{
				iscusReminder: false
			}
		},
		methods: {
			cusReminder() {
				this.iscusReminder = !this.iscusReminder
				this.$emit("toggleMenu");
				this.$emit('cusReminderForm')
			},
			close() {
				this.$emit("toggleMenu");
			},
			cusReminderForm() {
				this.iscusReminder = !this.iscusReminder
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
		},
		components: {
			cusReminderForm,
		}
	};
</script>

<style scoped>
	.td-modal-items {
		position: absolute;
		top: 100px;
		right: 0px;
		z-index: 100;
		overflow: auto;
		overflow-y: auto;
		/* background-color: white; */
	}
	@media screen and (max-width: 768px) {
	.td-modal-items {
		position: absolute;
		top: 200px;
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