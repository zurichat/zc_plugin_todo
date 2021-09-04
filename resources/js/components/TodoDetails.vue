<template>
    <div class="todo-details">
        <h3 class="title">Task: {{Title}}</h3>
        <p class="descrp text-secondary">Description: {{Description}}</p>
        <p class="text-primary"><i class="fas fa-calendar-alt"></i>Due: {{Due}}</p>
        <div>
        <div class="collabs">
        <p>Collaborators</p>
            <img src="../images/passport.jpg" alt="pic">
            <img src="../images/passport.jpg" alt="pic">
        </div>
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
    margin: 200px auto 50px;
    
}
img{
    width: 24px;
    border-radius: 50%;
}
.collabs{
    margin-bottom: 20px;
}
</style>