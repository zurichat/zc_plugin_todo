<template>
</template>
<style lang='scss'>
.logo-img {
    max-width: 300px;
}
</style>
<script>
import TodoItem from './Todo-item.vue'
    export default {
        name: "app",
        components: {
            TodoItem
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
