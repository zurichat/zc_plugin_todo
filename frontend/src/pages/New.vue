
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
            <div class="flex-grow px-4" >
                
                <SearchInput @searchTodo="searchTodo" />
                <div
      class="
        flex flex-col
        md:flex-row
        flex-start
        justify-start
        md:items-center
        md:justify-between
      "
    >
      <TodoNav @showLabel="showEditModal = true" />
      <AddTaskBtn @click="toggleModal" />
    </div>
            </div>
            <div class="px-1">
                <router-view />
            </div>
            <transition name="fade">
                    <shareModal
                        v-if="isShareModal"
                        @toggleShareModal="toggleShareModal"
                    />
                </transition>
                <transition name="fade">
                    <AssignForm 
                        v-if="isAssign"
                        @toggleShareModal="toggleShareModal"
                    />
                </transition>
            <transition name="fade">
                    <TodoForm v-if="isModal" @toggleModal="toggleModal" />
                </transition>
        </div>
        
    
    </div>
</template>
<script>
import AssignForm from '../components/AssignForm';
import { mapGetters } from "vuex";
import {mapActions} from 'vuex';
import TodoForm from "../components/TodoForm";
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
            isAssign: 'todos/isAssign'
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
        AssignForm,
        SearchInput,
        shareModal,
        TodoForm,
        TodoNav
    }
}
</script>
