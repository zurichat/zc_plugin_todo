<template>
   <Layout/> 
</template>
<style lang='scss'>
.logo-img {
    max-width: 300px;
}
</style>
<script>
import Layout from './Layout';
import TodoItem from './Todo-item';
    export default {
        name: "app",
        components: {
            TodoItem,
            Layout
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
