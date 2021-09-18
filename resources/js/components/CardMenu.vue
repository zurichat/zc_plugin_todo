<template>
  <div class="modal shadow-md ">
    <div class="grid overflow-visible bg-green-500 text-sm rounded-md shadow-md modal-items w-28 grid-row-5 ">
      <div class="flex flex-col mb-0 items">
        <span class="rounded-sm py-3 px-4 text-white font-bold cursor-pointer border-b border-green-400" >Edit</span>
        <span v-on="archiveid" class="rounded-sm py-3 px-4 text-white font-bold cursor-pointer border-b border-green-400" >Archive</span>
        <span class="rounded-sm py-3 px-4 text-white font-bold cursor-pointer "   >Delete</span>
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
    top: 15px;
    right:15px;
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