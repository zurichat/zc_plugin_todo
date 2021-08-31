<template>
    <div class="container mx-auto grid sm:grid-cols-2 gap-4 md:grid-cols-4">
        <TodoItem v-for="i in 8" :key="i"/>
    </div>
</template>

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
