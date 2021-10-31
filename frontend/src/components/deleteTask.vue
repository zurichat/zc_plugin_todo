<template>
	<div class="overlay">
		<div @submit.prevent="addTodo" v-click-away="ClickAway"
			class="td-w-3/5 td-h-2/5 md:td-w-2/5 td-flex td-flex-col td-justify-center td-items-center td-text-center td-sm:w-6/12 td-p-4 td-bg-white td-rounded ">
			<img src="../assets/img/delete_icon.svg" />
			<h1 class="td-text-lg td-font-semibold td-py-5">Delete Task</h1>
			<span class="td-text-sm td-px-4 td-pb-5 tracking-wider">You are about to delete your Task. Task
				deleted are
				sent to the trash and they are automatically deleted after 30
				days</span>
			<button @click="deleteItem"
				class="td-bg-red-500 td-text-white td-text-sm td-my-2 td-font-medium td-rounded td-px-4 td-py-2">
				Delete
			</button>
		</div>
	</div>
</template>

<script>
export default {
  name: 'deleteTask',
  data() {
    return {};
  },
  methods: {
    closeDelete() {
      console.log('hgey');
      this.$emit('toggleDeleteModal');
    },
    ClickAway() {
      this.$emit('toggleDeleteModal');
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
