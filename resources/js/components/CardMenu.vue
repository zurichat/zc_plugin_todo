<template>
  <div class="modal shadow-md ">
    <div class="grid overflow-visible border text-sm rounded-md shadow-md modal-items w-48 grid-row-5 ">
      <div class="flex flex-col mb-0 items">
        <span class="rounded-sm py-3 px-4 text-gray-900 font-normal text-sm cursor-pointer border-b hover:bg-green-400 hover:text-white" >Edit</span>
        <span @click="archive" class="rounded-sm py-3 px-4 text-gray-900 font-normal text-sm cursor-pointer border-b" >Archive</span>
        <span class="rounded-sm py-3 px-4 text-gray-900 font-normal text-sm cursor-pointer ">Delete</span>
      </div>

    </div>
  </div>
</template>

<script>
  export default {
    name: 'modal',
    methods: {
      close() {
        this.$emit('toggleMenu');
      },
      archive() {
        axios.post({
          url: '/task/'
        })
      }
    },
    props: {
      links : {
        type: Array
      }
    }
  };
</script>

<style scoped>
  .modal-items {
    position: absolute;
    top: 50px;
    right:-190px;
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
    color: #4AAE9B;
    background: transparent;
  }

  
</style>