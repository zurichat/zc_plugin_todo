<template>
  <div class="topnav">
<<<<<<< HEAD:resources/js/components/TodoNav.vue
    <router-link to="/new">
=======
      <router-link to="/">
>>>>>>> f2362dccbdcd57d4cba59e4cb8e0f81e00e67a6c:frontend/src/components/TodoNav.vue
      <span>Pending</span>
    </router-link>

    <router-link :to="{ name: 'Archive' }">
      <span>Archive</span>
    </router-link>

    <router-link :to="{ name: 'Trash' }">
      <span>Trash</span>
    </router-link>
  
  </div>
</template>

<script>
export default {
  name: "TodoNav"
}
</script>

<style scoped>
.topnav {
  /* position: fixed;
  top: 70px;
  width: 90%; */
  /* overflow: hidden; */
  display: flex;
  justify-content: flex-end;
}
/* Style the links inside the navigation bar */
.topnav a {
  display: flex;
  /* gap: 8px; */
  color: #999999;
  font-weight: 700;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 15px;
}
/* Change the color of links on hover */
.topnav a:hover {
  color: rgb(25, 146, 86);
}
/* Add a color to the active/current link */
a.router-link-exact-active {
  color: #00b87c;
}
</style>