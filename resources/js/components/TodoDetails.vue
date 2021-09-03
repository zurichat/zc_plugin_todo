<template>
    <div class="todo-details">
        <h3 class="title">Task: {{Title}}</h3>
        <h4 class="descrp">Description: {{Description}}</h4>
        <p><i class="fas fa-calendar-alt"></i>Due: {{Due}}</p>
        <div>
        <p>Collaborators</p>
        <img :src="pic" :alt="`{$pic}`">
        </div>
        <p class="recurring :">Recurring :{{Recurring}}</p>
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
        Description:{
            type: String,
            required: true,
            default: "Description",
        
        },
        Collaborators:{
            type: String,
            required: true,
            default: "../img/passport.png",
        
        },
        Due:{
            type: String,
            required: true,
            default: "Tomorrow",
        
        },
        Recurring:{
            type: String,
            required: true,
            default: "False",
        
        },
        
    },
};
</script>