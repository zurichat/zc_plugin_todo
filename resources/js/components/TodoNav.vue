<template>
  <div class="topnav">
    <router-link to="/new">
      <img src="/img/task.svg" />
      <span>Task</span>
    </router-link>

    <a href="#" @click.prevent="$emit('showLabel')">
      <img src="/img/label.svg" />
      <span>Labels</span>
    </a>

    <router-link :to="{ name: 'Archive' }">
      <img src="/img/archive.svg" />
      <span>Archive</span>
    </router-link>

    <router-link :to="{ name: 'Trash' }">
      <img src="/img/trash.svg" />
      <span>Trash</span>
    </router-link>
  </div>
</template>

<script>
export default {
  name: "TodoNav",
};
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