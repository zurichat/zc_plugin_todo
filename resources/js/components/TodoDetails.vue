<template>
    <div class="todo-details">
        <h3 class="title">Task: {{Title}}</h3>
        <h4 class="descrp">Description: {{Description}}</h4>
        <p><i class="fas fa-calendar-alt"></i>Due: {{Due}}</p>
        <div>
        <p>Collaborators</p>
        <img src="pic" :alt="`{$pic}`">
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
            default: "No",
        
        },
        
    },
};
</script>
<style scoped>
.todo-details{
    margin: auto 0 0 70%;
    line-height: 32px;
    width: 500px;
    height: 1000px;
    border: solid;
}
img{
    width: 24px;
    border-radius: 50%;
}

</style>