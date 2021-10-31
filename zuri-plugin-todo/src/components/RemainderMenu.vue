<template>
<div class="td-modal td-shadow-md">
    <div
      class="
        td-grid
        td-overflow-visible
        td-border
        td-text-sm
        td-rounded-md
        td-shadow-md
        td-modal-items
        td-w-48
        td-bg-white
        td-grid-row-5
      "
    >
      <div class="td-flex td-flex-col td-mb-0 items">
        <span
          class="
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
          >In 20 minutes</span
        >
        <span
          class="
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
          >In 1 hour</span
        >
        <span
          class="
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
          >In 2 hours</span
        >
        <span
          class="
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
          >Tomorrow</span
        >
          <span
          class="
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
          >New week</span
        >
          <span
          @click="toggleReminder"
          class="
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
          >Custom</span
        >
      </div>
    </div>
  </div>
</template>

<script>
// import axios from 'axios'
import { mapActions } from 'vuex';

export default {
  name: 'reminder-modal',
  methods: {
    ...mapActions({

    }),

    toggleReminder() {
      this.$emit('toggleReminderModal');
    },
    // close() {
    //   this.$emit("toggleMenu");
    // },

  },
  props: {

  },
};
</script>

<style scoped>
.td-modal-items {
  position: absolute;
  top: 150px;
  left: 310px;
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
