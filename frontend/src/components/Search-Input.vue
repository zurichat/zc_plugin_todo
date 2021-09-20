<template>
  <label
    class="
      rounded-lg
      border-2 border-gray-200
      p-2
      text-gray-300
      max-w-md
      flex
      justify-between
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