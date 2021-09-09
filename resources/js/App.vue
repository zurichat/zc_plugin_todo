<template>
  <!-- view for all pages -->
  <div id="view">
    <!-- the todo nav component -->
            <TodoNav @showLabel="showEditModal = true" />
    <router-view />
  </div>
</template>
<style lang='scss'>
#view {
  //width: 95%;
  margin: 0 auto;
}
@media (min-width: 424px) {
  #view {
    //  width: 90%;
  }
}
</style>
<script>
import TodoNav from "./components/TodoNav.vue";
export default {
  name: "app",
  mounted() {
    console.log("Component mounted.");
  },
  components: {
    TodoNav,
  },
};
</script>