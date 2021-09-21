<template>
    <div class="empty">
    <p class="text-gray-300 font-bold  text-lg md:text-xl  text-center ">{{title}}</p>
    <div class="image my-4">
      <img src="../assets/img/BigTrash.svg" />
      <span class="text-gray-300 font-bold  text-md md:text-lg  text-center">{{subtitle}}</span>
    </div>
  </div>
</template>
<script>
export default {
    name: 'Empty',
    props: {
        title: {
            type: String,
            },
             subtitle: {
            type: String,
            }
    }
}
</script>
<style lang="scss" scoped>
.empty {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  height: 60vh;

}
.image {
  border-radius: 0px;
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
}

</style>
