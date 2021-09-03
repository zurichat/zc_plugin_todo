<!---<template>
    <div>
        <h3>
            This is where we will be workinng
        </h3>
    </div>
    
</template>--->
<template>
    <div class="todo-details">
        <h3 class="title">Task Title</h3>
        <h4 class="descrp">Description</h4>
        <p><i class="fas fa-calendar"></i>Tomorrow</p>
        <p>Collaborators</p>
        <p class="recurring :">Recurring :</p>
    </div>
    
</template>

<script>
import TodoDetails from "../components/TodoDetails.vue"
export default {
    components: {TodoDetails},
    name: 'Main'
}

</script>
