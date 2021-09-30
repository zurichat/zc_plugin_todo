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
		<transition name="fade">
			<DeleteModal v-if="isDeleteModal" @toggleDeleteModal="toggleDeleteModal" />
		</transition>
	</div>
</template>

<script>
	import DeleteModal from './DeleteModal'
	export default {
		name: "td-modal",
		data(){
			return{
				isDeleteModal: false,
			}
		},
		methods: {
			toggleDelete() {
				this.isDeleteModal = !this.isDeleteModal;
				this.$emit('toggleDeleteModal')
			},
			toggleDeleteModal() {
				this.isDeleteModal = !this.isDeleteModal;
			},
		},
		components: {
			DeleteModal
		}
	};
</script>

<style scoped>
	.td-modal-items {
		position: absolute;
		top: 10px;
		right: 10px;
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