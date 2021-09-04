<template>
<<<<<<< HEAD
    <div class="center">
      
        <img src="./img/zuru.png" width="23" height="23" class="rounded-circle"/><br>
        Welcome to the place
    </div>
</template>
<style lang='scss'>


</style>
<script>
export default {
    name: "Main",
    data(){
        return{
        }
    }

}
</script>
<style scoped>
  img{
      margin:0 auto;
  }
  
 .center {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);

}
  
</style>
=======
  <section>
    <!-- <todo-nav /> -->
  </section>
</template>
<style lang="scss"></style>
<script>
import TodoNav from "./TodoNav.vue";
export default {
  components: { TodoNav },
  name: "Main",
  data() {
    return {};
  },
};
</script>
<style scoped>
img {
  margin: 0 auto;
}
</style>
>>>>>>> 27b5eaf0f01851494ee852786caed3c37108a28d
