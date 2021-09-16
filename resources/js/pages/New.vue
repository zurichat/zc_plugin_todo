<template>
    <div>
        
        <!-- <transition name="fade">
            <edit-label-modal
                v-if="showEditModal"
                @close="showEditModal = false"
            />
        </transition>
         -->
        <div>
            <div class="flex-grow px-4" :class="isComment ? 'hide' : 'show'">
                <div id="header">
                    <div id="logo " class="flex items-center flex-row">
                        <img class="w-8 m-4" :src="'./img/zuri-logo.svg'" />
                        <span class="font-bold text-lg">Zuri</span>
                    </div>
                </div>
                <transition name="fade">
                    <TaskForm v-if="isModal" @toggleModal="toggleModal" />
                </transition>
                <transition name="fade">
                    <shareModal
                        v-if="isShareModal"
                        @toggleShareModal="toggleShareModal"
                    />
                </transition>
                <!-- the create task button -->
                <!-- <AddTaskBtn @click="isComment = !isComment" /> -->
                <AddTaskBtn @click="toggleModal" />
                <!-- the search input component working -->
                <div class="flex flex-col md:flex-row flex-start  justify-start md:items-center md:justify-between">
                <SearchInput @searchTodo="searchTodo" /> <TodoNav @showLabel="showEditModal = true" />
                </div>
            </div>
            <div class="px-1">
                <router-view />
            </div>
            
        </div>
        
    
    </div>
</template>
<script>
import { mapGetters } from "vuex";
import {mapActions} from 'vuex';
import TaskForm from "../components/TaskForm";
import TodoNav from '../components/TodoNav'
import AddTaskBtn from '../components/AddTaskBtn'
import SearchInput from '../components/Search-Input'
import shareModal from "../components/shareModal";
// import TodoCard from "../components/TodoCard.vue";
export default {
    name: 'New Main',
    data() {
        return {
            isModal: false,
            isShareModal: false,
            showAll: true,
            isComment: false,
            showEditModal: false,
        };
    },computed: {
        ...mapGetters({
            allTodos: "todos/allTodos",
            
        }),
    },
    methods: {
        ...mapActions({
            searchValue: 'todos/SEARCH'
        }),
        toggleModal() {
            console.log("hi");
            this.isModal = !this.isModal;
        },
        toggleShareModal() {
            console.log("hi");
            this.isShareModal = !this.isShareModal;
        },
        isMobile() {
            if (
                /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                    navigator.userAgent
                )
            ) {
                return true;
            } else {
                return false;
            }
        },
        showComment() {
            this.isComment = true;
        },
        hideComment() {
            this.isComment = false;
        },
        searchTodo(val) {
                this.searchValue(val);
        },
        check() {
            if (this.$route.params.id) {
                this.showComment();
            } else {
                this.hideComment();
            }
        },
    },
    components: {
        // TodoCard,
        AddTaskBtn,
        SearchInput,
        shareModal,
        TaskForm,
        TodoNav
    }
}
</script>
