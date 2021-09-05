<template>
        <!-- <h3>
            This is where we will be working
        </h3> -->
        <div id="header">
            <div id="logo " class="flex items-center flex-row">
                <img class="w-8 m-4" :src="'./img/zuri-logo.svg'"/> <span class="font-bold text-lg">Zuri</span>
            </div>
        </div>
        <!-- <AddTaskForm /> -->
        <AddTaskBtn />
        <SearchInput />
        <div class="todo_container sm:grid sm:grid-cols-2 gap-4 md:grid-cols-3" >
        <taskCard v-for="i in 8" :key="i" title="Task title" date="Tomorrow" description="Description" />
    </div>
    
</template>
<script>
import SearchInput from '../components/Search-Input.vue'
    import taskCard from '../components/taskCard.vue'
<<<<<<< HEAD
    import TodoDetails from '../components/TodoDetails.vue'
=======
    import AddTaskForm from '../components/addTaskForm.vue'
    import AddTaskBtn from '../components/AddTaskBtn.vue'
>>>>>>> 4f6ca90a9e58b6370e321c0eadc2dfb210a031d8
    export default {
        name: 'Main',
        components: {
            taskCard,
            SearchInput,
<<<<<<< HEAD
            TodoDetails
=======
            AddTaskBtn,
            AddTaskForm
>>>>>>> 4f6ca90a9e58b6370e321c0eadc2dfb210a031d8
        }
    }
</script>
