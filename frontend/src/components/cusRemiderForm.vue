<template>
	<div class="overlay">
		<form @submit.prevent="addTodo" v-click-away="ClickAway"
			class="td-w-3/5 md:td-w-2/5 td-h-4/5 td-flex td-flex-col td-justify-center td-sm:w-6/12 td-p-4 td-bg-white td-rounded ">
			
			<div class="td-mb-4 ">
				<div class="td-flex td-flex-row td-w-full td-justify-between td-pb-1">
					<h1 class="td-font-bold td-text-xl td-capitalize">Reminder</h1>
					<div @click="closeModal" class="td-cursor-pointer"><i class="pi pi-times"></i></div>
				</div>
				<h4 class="td-text-gray-400 td-text-sm td-font-medium">West Central Africa</h4>
			</div>
			<div class="td-form-group td-flex td-flex-col td-py-4">
				<label class="td-pb-2 td-font-bold" for="dueDate">Due Date</label>
				<input required type="date"
					class="td-border td-border-gray-400 hover:td-border-green-400 td-bg-white td-outline-none text-gray-500 td-py-3 td-text-md td-w-full td-px-2 td-rounded" />
			</div>
			<div class="td-form-group td-flex td-flex-col td-py-4">
				<label class="td-pb-2 td-font-bold" for="dueDate">Time</label>
				<input required type="time" 
					class="td-border td-border-gray-400 hover:td-border-green-400 td-bg-white td-outline-none text-gray-500 td-py-3 td-text-md td-w-full td-px-2 td-rounded" />
			</div>
			<div class="td-form-group td-flex td-flex-col td-py-4">
				<label class="td-pb-2 td-font-bold" for="dueDate">Repeat</label>
				<select name="sel" id="sel" class="td-border td-border-gray-400 td-outline-none hover:td-border-green-400 td-bg-white td-outline-none text-gray-500 td-py-3 td-text-md td-w-full td-px-2 td-rounded">
					<option class="hover:td-bg-green-400 hover:td-text-white" value="daily">Daily</option>
					<option class="hover:td-bg-green-400 hover:td-text-white" value="Weekly">Weekly</option>
					<option class="hover:td-bg-green-400 hover:td-text-white" value="custom">Custom</option>
					<option class="hover:td-bg-green-400 hover:td-text-white" value="dnr">Do not repeat</option>
				</select>
			</div>
			<div class="td-flex td-justify-end">
				<button @click="deleteItem"
					class="td-bg-green-400 td-text-white td-text-sm td-my-4 td-font-medium td-rounded td-px-4 td-py-2 td-w-40">
					Add Reminder
				</button>
			</div>
		</form>
	</div>
</template>

<script>
	export default {
		name: "cusReminderForm",
		data() {
			return {};
		},
		computed: {
		},
		methods: {
			closeDelete() {
				console.log("hgey");
				this.$emit("toggleDeleteModal");
			},
			ClickAway() {
				this.$emit("cusReminderForm");
			},
			closeModal(){
				this.$emit("cusReminderForm");
			},
			deleteItem() {
				this.$emit("toggleDeleteModal");
				//   function to call action in the vuex store
				this.deleteTodo(this.id);
			}
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