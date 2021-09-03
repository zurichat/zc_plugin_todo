<template>
    <div class="todo-details">
        <h3 class="title">{{Title}}</h3>
        <h4 class="descrp">Description</h4>
        <p><i class="fas fa-calendar-alt"></i>Tomorrow</p>
        <p>Collaborators</p>
        <p class="recurring :">Recurring :</p>
    </div>
    
</template>
<script>
export default{
    name: "TodoDetails",
    props:{
        Title:{
            type: String,
            required: true,
            default: "Task Title",
        
        },
    },
};
</script>