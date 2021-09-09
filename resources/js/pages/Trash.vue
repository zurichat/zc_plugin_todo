<template>
  <div class="trash">
    <p>All Trash in tasks will be deleted after 7 days</p>
    <div class="image">
      <img src="/img/BigTrash.svg" />
      <span>No Tasks in Trash</span>
    </div>
  </div>
</template>

<script>
export default {
  name: "Trash",
};
</script>

<style scoped>
.trash {
 display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  height: 80vh;
  gap: 130px;
}
p {
color: #999999;
 font-weight: bold;
 font-size: 24px;
}

.image {
  border-radius: 0px;
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
}
span {
  font-weight: 700;
  font-size: 24px;
  color: #999999; 
}
</style>