<template>

    <input
      type="text"
      @input="search"
      v-model="value"

      class="ml-8 bg-transparent text-black outline-none td-rounded-lg
      td-border td-border-gray-200
      td-p-2
      td-text-gray-500
      td-max-w-md
      td-text-base
      md:td-m-6/12
      td-h-14
      td-w-full
      td-flex
      td-justify-between"
    />

</template>
<script>
export default {
  name: 'Search-Input',
  data() {
    return {
      value: '',
    };
  },
  methods: {
    search() {
      this.$emit('searchTodo', this.value);
    },
  },
};
</script>
