<template>
    <div
        id="TodoCard"
        class="td-px-4 td-py-2 td-mx-auto hover:td-border td-cursor-pointer td-my-4 sm:td-my-0 taskcard sm:td-mx-0 td-relative"
    >
    
        <div v-click-away="ClickAway">
            <div
                class="menu_btn td-px-6 td-py-3 td-absolute td-top-0 td-right-0"
                @click="toggleMenu"
            >
                <i class="pi pi-ellipsis-h"></i>
            </div>
            <MenuDropdown
                :links="links"
                v-show="isModalVisible"
                :todo="todo"
                @toggleDeleteModal="toggleDeleteModal"
                @toggleMenu="toggleMenu"
                @archived="handleArchivedTodo"
            />
        </div>
        <div @click="details()">
            <div class="td-flex td-justify-between">
                <div id="card_title td-py-3">
                    <p class="title td-font-bold  td-capitalize">
                        {{ todo.title }}
                    </p>
                    <p
                        class="description td-text-gray-400 td-font-bold td-text-sm "
                    >
                        {{ description }}...
                    </p>
                </div>
            </div>
            <div class="td-flex td-justify-between td-items-center">
                <div class="collaborators td-font-medium td-text-sm">
                    <span class="td-font-bold td-text-gray-700 td-block"
                        >Collaborators</span
                    >
                    <div class="td-flex ">
                        <img src="../assets/img/collaborators.svg" />
                        <span
                            class="td-text-white td-mx-0.5 td-bg-green-500 td-h-6 td-rounded td-px-2 td-py-1 td-text-xs td-select-none"
                            >{{ collaborators   }}</span
                        >
                    </div>
                </div>
                <div class="percent">
                    <CircleProgress :size="67" :border-width="5" :border-bg-width="5" empty-color="#F6F6F6" fill-color="#00B87C"
                       :percent="percent" :show-percent="true" />
                </div>
            </div>
            <div class="td-flex td-justify-between td-my-2">
                <div
                    class="td-flex td-items-center td-text-gray-400  td-text-sm"
                >
                    <i class="pi pi-calendar"></i>
                    <span class="td-px-1">{{ todo.created_at.slice(0, 10)    }}</span>
                </div>
                <div
                    class="td-flex td-items-center td-text-gray-400  td-text-sm"
                >
                    <svg
                        width="20"
                        height="20"
                        viewBox="0 0 20 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M6.39199 1.66656H13.617C16.442 1.66656 18.3336 3.6499 18.3336 6.5999V13.4091C18.3336 16.3499 16.442 18.3332 13.617 18.3332H6.39199C3.56699 18.3332 1.66699 16.3499 1.66699 13.4091V6.5999C1.66699 3.6499 3.56699 1.66656 6.39199 1.66656ZM9.52531 12.4916L13.4836 8.53325C13.767 8.2499 13.767 7.79157 13.4836 7.4999C13.2003 7.21657 12.7336 7.21657 12.4503 7.4999L9.00864 10.9416L7.55032 9.48325C7.26699 9.19992 6.80033 9.19992 6.51699 9.48325C6.23366 9.76658 6.23366 10.2249 6.51699 10.5166L8.50031 12.4916C8.64198 12.6332 8.82531 12.6999 9.00864 12.6999C9.20031 12.6999 9.38364 12.6332 9.52531 12.4916Z"
                            fill="#999999"
                        ></path>
                    </svg>
                    <span class="td-px-1">{{ todo.tasks.length }} tasks</span>
                </div>
            </div>
        </div>
        <transition name="fade">
            <DeleteModal
                v-if="isDeleteModal"
                :title="todo.title"
                :id="todo._id"
                @toggleDeleteModal="toggleDeleteModal"
            />
        </transition>
    </div>
</template>
<script>
// import Progress from "easy-circular-progress";x
//  import Progress from './Progress';
import CircleProgress from "vue3-circle-progress";
import DeleteModal from "./DeleteModal";
import MenuDropdown from "./MenuDropdown.vue";
import { mapActions } from "vuex";
export default {
    name: "TodoCard",
    data() {
        return {
            isModalVisible: false,
            isDeleteModal: false,
            links: [
                {
                    name: "Edit",
                    action: () => {
                        this.toggleMenu();
                        // this.$emit('toggleShareModal')
                        //alert('You cant assign tasks now')
                    },
                    type: "default"
                },
                {
                    name: "Delete",
                    action: () => {
                        this.toggleMenu();
                        alert("completed");
                    },
                    type: "default"
                }
            ]
        };
    },
    components: {
        MenuDropdown,
        CircleProgress,
        DeleteModal
    },
    computed: {
         
         description() {
             let value = 1;
             if (this.todo.description != undefined) {
                 value = this.todo.description.slice(0, 20);
             } 
             return value;
         },
         percent(){
             const all = this.todo.tasks;
             let value =1
             if(all.length != 0){
                 const completed = all.filter((task) => task.status === 1)
                 value = (completed.length/all.length) * 100;
             }
             value = value <= 0 ? 1 : value;
             return value;
         },
          collaborators() {
             let value = "";
             if (this.todo.colaborators === undefined) {
                 value = this.todo.collaborators.length;
             } else {
                 value = this.todo.colaborators.length;
             }
             return value;
         }

    },
    methods: {
        ...mapActions({
            delete: "todos/ADD_TRASH",
            archive: "todos/ADD_ARCHIVE"
        }),
        toggleDeleteModal() {
            this.isDeleteModal = !this.isDeleteModal;
        },
        ClickAway() {
            this.isModalVisible = false;
        },
        details() {
            this.$router.push({
                name: "Details",
                params: { id: this.todo._id }
            });
        },
        toggleMenu() {
            this.isModalVisible = !this.isModalVisible;
        },

        closeModal() {
            this.isModalVisible = false;
        },
        alert() {
            alert("hi");
        },
        handleArchivedTodo() {
            this.$emit("archived", this.todo);
        }
    },

    props: {
        todo: {
            type: Object
        }
    }
};
</script>

<style lang="scss" scoped>
.percent {
    transform: translateY(-15px);
}
.taskcard {
    background: #ffffff;
    // border: 1px solid #dadada;
    box-sizing: border-box;
    border-radius: 0.6em;
    max-width: 30em;
    box-shadow: 0px 0px 15px #e7e7e7de;
}
</style>
