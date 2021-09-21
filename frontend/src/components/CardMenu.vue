<template>
<div class="modal shadow-md">
    <div
      class="
        grid
        overflow-visible
        border
        text-sm
        rounded-md
        shadow-md
        modal-items
        w-48
        bg-white
        grid-row-5
      "
    >
      <div class="flex flex-col mb-0 items">
        <span
          class="
            rounded-sm
            py-3
            px-4
            text-gray-900
            font-normal
            text-sm
            cursor-pointer
            border-b
            hover:bg-green-400
            hover:text-white
          "
          @click="assign()"
          >Assign Collaborators</span
        >
        <span
          class="
            rounded-sm
            py-3
            px-4
            text-gray-900
            font-normal
            text-sm
            cursor-pointer
            border-b
            hover:bg-green-400
            hover:text-white
          "
          >Get notified about new replies</span
        >
        <span
          class="
            rounded-sm
            py-3
            px-4
            text-gray-900
            font-normal
            text-sm
            cursor-pointer
            border-b
            hover:bg-green-400
            hover:text-white
          "
          >Remind me about this</span
        >
        <span
          @click="archive"
          class="
            rounded-sm
            py-3
            px-4
            text-gray-900
            font-normal
            text-sm
            cursor-pointer
            border-b
            hover:bg-green-400
            hover:text-white
          "
          >Archive</span
        >
        <span
          class="
            rounded-sm
            py-3
            px-4
            text-gray-900
            font-normal
            text-sm
            cursor-pointer
            hover:bg-green-400
            hover:text-white
          "
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
  name: "modal",
  methods: {
    ...mapActions({
      tog_assign: 'todos/toggleAssign'
    }),
   assign(){
     this.$emit("toggleMenu");
     this.tog_assign()
   },
    close() {
      this.$emit("toggleMenu");
    },
    archive() {
      console.log(this.todo._id);
      axios
        .post(
          `task/${this.todo._id}/toggleArchiveStatus`,
            
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
.modal-items {
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