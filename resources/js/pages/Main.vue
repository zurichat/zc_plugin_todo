<template>
    <div>
        <h3>
            This is where we will be working
        </h3>
        <taskCard title="Task title" date="Tomorrow" description="Description" />
    </div>
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