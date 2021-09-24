
<template>
    <div>
        
        <!-- <transition name="fade">
            <edit-label-modal
                v-if="showEditModal"
                @close="showEditModal = false"
            />
        </transition>
         -->
         
        <div class="td-py-4">
            <div class="td-flex-grow td-px-4" >
                
                <SearchInput @searchTodo="searchTodo" />
                <div
      class="
        td-flex td-flex-col
        md:td-flex-row
        td-flex-start
        td-justify-start
        md:td-items-center
        md:td-justify-between
      "
    >
      <TodoNav @showLabel="showEditModal = true" />
      <AddTaskBtn @click="toggleModal" />
    </div>
            </div>
            <div class="td-px-1">
                <router-view />
            </div>
            
                <transition name="fade">
                    <AssignForm 
                        v-if="isAssign"
                        @toggleDeleteModal="toggleDeleteModal"
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

// import TodoCard from "../components/TodoCard.vue";
export default {
    name: 'New Main',
    data() {
        return {
            isModal: false,
            
            showAll: true,
            isComment: false,
            
            showEditModal: false,
            centrifuge: null
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
        
        TodoForm,
        TodoNav
    },
    mounted(){
        // this.centrifuge = new Centrifuge('wss://realtime.zuri.chat/connection/websocket');
        // this.centrifuge.connect();
        // this.centrifuge.subscribe('Didier', function(messageCtx) {
        //     console.log(messageCtx);
        // })
    }
}
</script>
