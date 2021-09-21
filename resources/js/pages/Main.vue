<template>
    <div
        id="main_view"
        class="section_grid p-2"
    >
        <div>
            <template v-if="showAll">
                <div v-if="allTodos.length <= 0">
                    <Empty
                        :title="'Oops Your Todo Store is Empty'"
                        :subtitle="'Click Create Task Button'"
                    />
                </div>
                <div
                    v-else
                    class="
                         todo_container
 sm:grid sm:grid-cols-2
gap-4
 md:grid-cols-3
 lg:grid-cols-4 
                    "
                >
                    <NewCard
                        v-for="(todo, index) in allTodos"
                        :key="index++"
                        :todo="todo"
                    />
        </div>
        </template>
        <template v-else>
            <div class="
                        todo_container
                        sm:grid sm:grid-cols-2
                        gap-4
                        md:grid-cols-3
                        lg:grid-cols-4
                    ">
                <NewCard
                    v-for="(todo, index) in result"
                    :key="index"
                    :todo="todo"
                />
            </div>
        </template>
        </div>
        </div>
</template>
<script>

import SearchInput from '../components/Search-Input.vue'
    import taskCard from '../components/taskCard.vue'
    import addTodo from '../components/addTodo.vue'
    import addTodo from '../components/Contributors.vue'
    export default {
        name: 'Main',
        components: {
            taskCard,
            SearchInput,
            addTodo,
            collaborators
        }
    }

</script>
<style lang="scss"></style>
