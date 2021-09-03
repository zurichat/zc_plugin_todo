<template>
    <div class="w-4/5 mx-auto todo_item border sm:w-full m-2 rounded-md bg-white "></div>
</template>
<script>
    export default {
        name: "Todo-Item",
        data(){
            return{
                todos:'',
                form: new Form({
                    title: '',
                    description: '',
                    date: ''
                })
            }
        },
        // Function to Add Task
        methods:{
            AddTask(){
                    axios.get('/').then((res) =>{
                        this.todos = res.data
                    }).catch((error) =>{
                        console.log(error)
                    })
            }
        }
    }
</script>
<style lang="scss" scoped>
    .todo_item {
        min-height: 10rem;
    }
</style>