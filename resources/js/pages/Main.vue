<template>
    <div>
        <!-- <h3>
            This is where we will be working
        </h3> -->
        <div id="header">
            <div id="logo " class="flex items-center flex-row">
                <img class="w-8 m-4" :src="'./img/zuri-logo.svg'" />
                <span class="font-bold text-lg">Zuri</span>
            </div>
        </div>
        <!-- <AddTaskForm /> -->
        <!-- transition for the modal components -->
        <transition name="fade">
            <TaskForm v-if="isModal" @toggleModal="toggleModal" />
        </transition>

        <transition name="fade">
            <edit-label-modal v-if="show_label" @close="show_label = false" />
        </transition>

        <!-- the create task button -->
        <AddTaskBtn @click="toggleModal" />
        <!-- the search input component working -->
        <SearchInput @searchTodo="searchTodo" />
        <!-- the todo nav component -->
        <TodoNav @showLabel="show_label = true" />
        <!-- the grid div tag for the todo container and the comment section -->
        <div id="main_view" class="section_grid">
            <div>
                <template v-if="showAll">
                    <div
                        class="
                            todo_container
                            sm:grid sm:grid-cols-2
                            gap-4
                            md:grid-cols-3
                        "
                    >
                        <taskCard
                            v-for="(todo, index) in allTodos"
                            :key="index"
                            :title="todo.title"
                            :date="todo.startDate"
                            :description="todo.description"
                        />
                    </div>
                </template>
                <template v-else>
                    <div
                        class="
                            todo_container
                            sm:grid sm:grid-cols-2
                            gap-4
                            md:grid-cols-3
                        "
                    >
                        <taskCard
                            v-for="(todo, index) in searchedValues"
                            :key="index"
                            :title="todo.title"
                            :date="todo.startDate"
                            :description="todo.description"
                        />
                    </div>
                </template>
            </div>
            <!-- comment section still under construction -->
            <div id="comment">
                <router-view />
            </div>
        </div>
    </div>
</template>
<script>
import SearchInput from "../components/Search-Input.vue";
import taskCard from "../components/taskCard.vue";
import TodoNav from "../components/TodoNav.vue";
import AddTaskForm from "../components/addTaskForm.vue";
import AddTaskBtn from "../components/AddTaskBtn.vue";
import TaskForm from "../components/TaskForm";
import EditLabelModal from "resources/js/components/EditLabelModal";

import { mapGetters } from "vuex";
import EditLabelModal from "../components/EditLabelModal.vue";
export default {
    name: "Main",
    data() {
        return {
            isModal: false,
            showAll: true,
            searchedValues: [],
            show_label: false,
        };
    },
    computed: {
        ...mapGetters({
            allTodos: "todos/allTodos",
        }),
    },
    methods: {
        toggleModal() {
            console.log("hi");
            this.isModal = !this.isModal;
        },
        searchTodo(val) {
            if (val === "") {
                this.showAll = true;
            } else {
                this.showAll = false;
                this.searchedValues = this.allTodos.filter(
                    (todo) =>
                        todo.title.toLowerCase().indexOf(val.toLowerCase()) >= 0
                );
            }
        },
    },
    components: {
        taskCard,
        SearchInput,
        TodoNav,
        AddTaskBtn,
        AddTaskForm,
        TaskForm,
        EditLabelModal,
        EditLabelModal,
    },
};
</script>
