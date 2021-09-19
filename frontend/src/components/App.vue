<template>
    <div class="sm:w-4/5 mx-auto">
        <div class="flex items-center m-4 text-black"> <img class="inline m-2 w-5" :src="'/img/Vue.js_Logo.svg'" alt="">
            <span class="italic">Vue Installation was Successful<span class="text-green-500">&nbsp;!!!!</span></span>
        </div>
        <div class="sm:grid sm:grid-cols-2 flex flex-col justify-center flex-start  items-center w- my-10 sm:my-20">
            <div class="logo-img w-3/5 mx-auto">
                <img class="w-full" :src="'/img/zuri-logo.svg'" alt="">
            </div>
            <div class="my-10 text-center text-gray-800 sm:text-left">
                <span class="block montserrat text-3xl sm:text-5xl"><span class="text-green-500">Zuri</span>-<span
                        class="text-pink-500">Chat</span> Todo Plugin</span>
                <span class="block my-2 italic font-medium">This Plugin is Still under Construction!!!</span>
            </div>
        </div>
    </div>
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