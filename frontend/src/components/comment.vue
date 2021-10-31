<template>
	<div class="overlay">
		<div class="comment td-w-2/3 lg:td-w-full td-bg-white td-rounded-md">
			<div class="td-bg-gray-50 td-w-full td-flex td-justify-between td-px-4">
				<span class=" td-py-4">
					<h2 class="td-text-xl td-font-semibold title">
						Comments
					</h2>
					<p class="td-text-gray-400 td-pb-1 td-text-lg td-font-medium">
						<span class="task_number">{{ selectedTodo }}</span>
					</p>
				</span>
				<div @click="closeModal" class="td-p-2 td-cursor-pointer"><i class="pi pi-times td-text-xl"></i></div>
			</div>
			<div class="scrollbar td-h-30 lg:td-70 td-overflow-auto td-pt-3 td-px-3">
				<div v-for="comment in comments" :key="comment" class="td-place-self-start td-flex td-px-3 td-py-3">
					<div class="td-self-start td-flex-none td-w-10">
						<img class="td-mr-1" src="../assets/img/zuri.svg" alt="">
					</div>
					<div class="td-flex td-flex-col">
						<span class="mx-4 td-flex-grow">
							<p class="task_title td-text-md td-font-semibold">{{ selectedTodo }}</p>
							<p class="td-text-xs td-text-gray-300 td-font-light ml-8"></p>
							<p class="">{{comment}}</p>
						</span>
					</div>
				</div>
			</div>
			<!-- <form class=""> -->
			<div class="td-comment-group td-px-3">
				<textarea v-on:keyup.enter="addComment" v-model="text" class="td-self-end td-w-full textarea td-pl-2 td-py-2 td-rounded td-w-full td-shadow-lg td-outline-none td-shadow-inner td-pr-7
														td-border hover:td-border-green-400 td-bg-white" placeholder="Add Comment..."></textarea>
				<button @click.prevent="addComment" class="icon-user td-outline-none"><i
						class="pi pi-send td-text-gray-400 td-text-xl"></i></button>
			</div>
			<!-- </form> -->
		</div>
	</div>
</template>
<script>
export default {
  components: {
  },
  data() {
    return {
      comments: [],
      text: '',
    };
  },
  methods: {
    closeModal() {
      this.$emit('showComment');
    },
    addComment() {
      const oldComment = this.comments;
      if (this.text !== '') {
        oldComment.push(this.text);
        this.comments = oldComment;
        this.text = '';
      }
    },
  },
  props: {
    selectedTodo: {
      type: String,
    },
  },
};

</script>
<style scoped>
	.td-comment-group {
		position: relative;
		height: 200px;
		width: 100%;
	}

	.td-comment-group textarea {
		height: 200px;
		width: 100%;
	}

	.icon-user {
		position: absolute;
		width: 16px;
		height: 16px;
		right: 30px;
		top: 10px;
	}

	@media screen and (max-width: 768px) {
		.overlay {
			line-height: 1.46666667;
			align-items: center;
			background: rgba(0, 0, 0, 0.6);
			display: flex;
			height: 100%;
			justify-content: center;
			left: 0;
			/* opacity: 0; */
			position: fixed;
			top: 0;
			transition: 80ms linear;
			width: 100%;
			z-index: 1012;
		}
	}

	/* width */
	.scrollbar::-webkit-scrollbar {
		width: 10px;
	}

	/* Track */
	.scrollbar::-webkit-scrollbar-track {
		background: #f1f1f1;
	}

	/* Handle */
	.scrollbar::-webkit-scrollbar-thumb {
		background: #888;
	}

	/* Handle on hover */
	.scrollbar::-webkit-scrollbar-thumb:hover {
		background: #555;
	}
</style>
