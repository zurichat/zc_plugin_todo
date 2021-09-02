<template>
    <div>
        <h3>
            This is where we will be working
        </h3>
        <div class="todo_container sm:grid sm:grid-cols-2 md:grid-cols-3" >
        <taskCard v-for="i in 8" :key="i" title="Task title" date="Tomorrow" description="Description" />
    </div></div>
</template>
<script>
    import taskCard from '../components/taskCard.vue'
    export default {
        name: 'Main',
        components: {
            taskCard
        }
    }
</script>
