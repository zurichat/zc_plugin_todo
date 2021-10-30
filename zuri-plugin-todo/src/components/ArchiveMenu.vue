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
          @click="restore"
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
          >Restore</span
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
import axios from 'axios';
import { mapActions, mapGetters } from 'vuex';

export default {
  name: 'td-modal',
  computed: { ...mapGetters({ org_id: 'todos/organization', user: 'todos/user' }) },
  methods: {
    ...mapActions({
      tog_assign: 'todos/toggleAssign',
    }),
    toggleDelete() {
      this.$emit('toggleMenu');
      this.$emit('toggleDeleteModal');
    },
    close() {
      this.$emit('toggleMenu');
    },
    restore() {
      console.log(this.todo._id);
      axios
        .put(
          `unarchive-todo/${this.todo._id}?user_id=${this.user.id}&organisation_id=${this.org_id}`,

          {
            restored_at: 1,
          },
        )
        .then(() => {
          this.$emit('restored');
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
