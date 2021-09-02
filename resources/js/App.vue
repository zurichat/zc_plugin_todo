<template>
<!-- view for all pages -->
    <div id="view" >
        <router-view />
    </div> 
</template>
<style lang='scss'>

</style>
<script>
    export default {
        name: "app",
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
