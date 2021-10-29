<template>
  <div class="overlay">
    <div
      @submit.prevent="addTodo"
      v-click-away="ClickAway"
      class="td-w-3/5 md:td-w-2/5 td-h-2/5 td-flex td-flex-col td-justify-center td-items-center td-text-center td-sm:w-6/12 td-p-4 td-bg-white td-rounded "
    >
      <img src="../assets/img/delete_icon.svg" />
      <!-- <span class="td-md-w-4/ td-text-sm"
                >You are about to delete your {{ title }}. Todos deleted are
                sent to the trash and they are automatically deleted after 30
                days</span -->
      <span class="td-md-w-4/ td-text-sm"
        >You are about to delete your {{ title }} Todod, are you sure about this</span
      >
      <div class="d-flex flex-wrap ">
        <button
          @click="deleteItem"
          class="td-bg-red-500 td-text-white td-text-sm td-my-2 td-font-medium td-rounded td-px-4 td-py-2"
        >
          Delete
        </button>
        &nbsp;
        <button
          @click="$emit('toggleDeleteModal')"
          class="td-bg-green-500 td-text-white td-text-sm td-my-2 td-font-medium td-rounded td-px-4 td-py-2"
        >
          Cancel
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DeleteModal',
  data() {
    return {};
  },
  computed: {},
  methods: {
    closeDelete() {
      console.log('hgey');
      this.$emit('toggleDeleteModal');
    },
    ClickAway() {
      this.$emit('toggleDeleteModal');
    },
    deleteItem() {
      this.$emit('toggleDeleteModal');
      //   function to call action in the vuex store
      this.$emit('deleteItem', this.id);
    },
  },
  props: {
    title: {
      type: String,
    },
    id: {
      type: String,
    },
  },
};
</script>

<style lang="scss" scoped>
//   * {
//     margin: 0;
//     box-sizing: border-box;
//   }

.overlay {
  line-height: 1.46666667;
  align-items: center;
  background: rgba(0, 0, 0, 0.6);
  display: flex;
  height: 100%;
  justify-content: center;
  left: 0;
  // opacity: 0;
  position: fixed;
  top: 0;
  transition: 80ms linear;
  width: 100%;
  z-index: 1012;
}
</style>
