<template>
  <div class="topnav">
    <a class="active" href="#">
      <img src="/img/task.svg" />
      <span>Task</span>
    </a>

    <a href="#">
      <img src="/img/label.svg" />
      <span>Labels</span>
    </a>

    <a href="#">
      <img src="/img/archive.svg" />
      <span>Archive</span>
    </a>

    <a href="#">
      <img src="/img/trash.svg" />
      <span>Trash</span>
    </a>
  </div>
</template>

<script>
export default {
  name: "TodoNav",
};
</script>
<style scoped>
.topnav {
  overflow: hidden;
  display: flex;
  justify-content: flex-end;
}
/* Style the links inside the navigation bar */
.topnav a {
  display: flex;
  gap: 8px;
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
.topnav a.active {
  color: #00b87c;
}
</style>