<template>
    
    <div class="container">
        <h1>Function to add todo task</h1>
        <input type="text" placeholder="Type todo" v-model="todo">
        <button value="Add Todo" @click="addTodo">Add todo</button>
        <ul>
            <li v-for="todo in todos">
                {{todo}}
            </li>
        </ul>
    </div>
    
</template>

<script>
export default {
    name: "addTodo",
    data: {
            todo: '',
            todos:[]
        },
        methods: {
            addTodo(){
                this.todos.push(this.todo)
                this.todo = ''            
            }
        }
}
</script>