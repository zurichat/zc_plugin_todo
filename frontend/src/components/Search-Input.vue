<template>
  <label
    class="
      td-rounded-lg
      td-border-2 td-border-gray-200
      td-p-2
      td-text-gray-300
      td-max-w-md
      td-flex
      td-justify-between
    "
    for="search"
  >
    <input
      type="text"
      @input="search"
      v-model="value"
      placeholder="Search here"
      class="ml-8 bg-transparent text-black outline-none w-4/5"
    />
  </label>
</template>
<script>
export default {
  name: "Search-Input",
  data() {
    return {
      value: "",
    };
  },
  methods: {
    search() {
      this.$emit("searchTodo", this.value);
    },
  },
};
</script>