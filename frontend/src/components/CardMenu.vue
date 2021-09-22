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
          @click="assign()"
          >Assign Collaborators</span
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
          >Get notified about new replies</span
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
          >Remind me about this</span
        >
        <span
          @click="archive"
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
          >Archive</span
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
            hover:td-bg-red-500
            hover:td-text-white
          "
          @click="toggleDelete"
          >Delete</span
        >
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { mapActions } from 'vuex'
export default {
  name: "td-modal",
  methods: {
    ...mapActions({
      tog_assign: 'todos/toggleAssign'
    }),
   assign(){
     this.$emit("toggleMenu");
     this.tog_assign()
   },
   toggleDelete(){
     this.$emit("toggleMenu");
     this.$emit('toggleDeleteModal')
   },
    close() {
      this.$emit("toggleMenu");
    },
    archive() {
      console.log(this.todo._id);
      axios
        .put(
          `archive-todo/${this.todo._id}`,
            
          {
            archived_at: 1,
          }
        )
        .then(() => {
          this.$emit("archived");
        });
    },
  },
  props: {
    links: {
      type: Array,
    },
    todo: {
      type: Object,
    },
  },
};
</script>

<style scoped>
.td-modal-items {
  position: absolute;
  top: 40px;
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