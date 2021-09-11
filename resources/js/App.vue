<template>
  <!-- view for all pages -->
  <div id="view_section">
    <!-- the todo nav component -->
    <div>
      <!-- <TodoNav @showLabel="showEditModal = true" /> -->
      <router-view />
    </div>
  </div>
</template>
<style lang='scss'>
#view_section {
   // display: flex;
}

@media (min-width: 786px) {
    #view_section {
        padding: 0 2rem;
    }
}

#comment {
    min-height: 100vh;
    width: 100%;
    border-left: 0.5px solid lightgrey;
}

@media (min-width: 768px) {
    #comment {
        width: 25%;
    }
}

// #comment.hide {
//   display: none
// }

// #comment.show {
//   display: block
// }

@media (max-width: 768px) {
    .hide {
        display: none;
    }

    #view_section {
        display: block !important;
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