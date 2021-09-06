<template>
<!-- view for all pages -->
    <div id="view" >
        <router-view />
    </div> 
</template>
<style lang='scss'>

    #view {
        width: 95%;
        margin: 0 auto;
}
@media (min-width: 424px) {
    #view {
        width: 90%;
    
    }
}

</style>
<script>
    export default {
        name: "app",
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>