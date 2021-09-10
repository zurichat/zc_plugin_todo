<template>
   <div class="archive">
    <p>Your Archived Tasks will be added here</p>
    <div class="image">
      <img src="/img/BigTrash.svg" />
      <span>No Tasks in Archive</span>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Archive',
};
</script>

<style scoped>
.archive {
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
  font-weight: bold;
  font-size: 24px;
  color: #999999; 
}
</style>