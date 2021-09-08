<template>
  <div class="modal shadow-md">
    <div class="grid overflow-visible text-sm rounded-md shadow-md modal-items w-44 grid-row-5 ">
      <button class="flex mb-2 border content-right mx-right justify-items-end position-absolute btn-close"
        type="button" @click="close">
        x
      </button>
      <div class="flex flex-col mt-8 mb-0 items">
        <span class="rounded-sm py-2 px-4 cursor-pointer" v-for="(link, index) in links" :key="index" @click="link.action" :class=" link.type === 'default' ? 'hover:bg-green-100' : 'hover:bg-red-500 hover:text-white'" >{{link.name}}</span>
        
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
    background-color: white;
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