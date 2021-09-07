<template>
  <div class="modal">
    <div class="grid ml-56 overflow-visible text-sm rounded-md shadow-md modal-items w-44 grid-row-5 h-72">
      <button class="flex mb-2 border content-right mx-right justify-items-end position-absolute btn-close"
        type="button" @click="close">
        x
      </button>

      <div class="flex flex-col mt-8 mb-0 items">
        <a class="rounded-sm hover:bg-gray-100" href="#">Assign task</a>
        <a class="rounded-sm hover:bg-gray-100" @click="showShareModal">Share k</a>
        <a class=" rounded-sm hover:bg-gray-100" href="#">Mark as completed</a>
        <a class="rounded-sm hover:bg-gray-100" href="#">Archive</a>
        <a class="rounded-sm hover:bg-red-500 hover:text-white" href="#">Delete</a>
      </div>
    </div>
    <transition name='fade'>
      <shareModal v-show="isShareModalVisible" @close="closeShareModal" @toggleShareModal='toggleShareModal' />
    </transition>
  </div>
</template>

<script>
  import shareModal from './shareModal.vue';
  export default {
    name: 'modal',
    data() {
      return {
        isShareModalVisible: false,
      };
    },
    methods: {
      close() {
        this.$emit('close');
      },
      showShareModal() {
        this.isShareModalVisible = true;
      },
      closeShareModal() {
        this.isShareModalVisible = false;
      }
    },
  };
</script>

<style>
  .modal-items {
    position: absolute;
    top: 300px;
    right: 100px;
    left: 310px;
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
    color: #4AAE9B;
    background: transparent;
  }

  .items a {
    padding-top: 15px;
    padding-bottom: 15px;
    padding-left: 25px;
  }
</style>