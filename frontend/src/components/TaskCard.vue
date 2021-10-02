<template>
    <div
        class="td-pl-4 td-m-4 task_box td-flex td-py-2 hover:td-shadow td-border-b "
    >
        <!-- <Checkbox v-model="checked" :id="'city' + index" name="city" :value="'Chicago' + index" /> -->
        <div class="task_content td-flex-grow td-pl-2">
            <div class="td-flex td-justify-between">
                <p class="task_title td-pb-3 td-font-medium">
                    <span class="task_number">Task 0{{ index + 1 }} -</span>
                    {{ task.title }}
                </p>
                <div v-click-away="ClickAway" class="">
                    <div @click="toggleMenu">
                        <i class="pi pi-ellipsis-v td-cursor-pointer"></i>
                    </div>
                    <div class="td-relative">
                        <taskDropdown
                            v-show="isModalVisible"
                            @toggleDeleteModal="toggleDeleteModal"
                            @toggleMenu="toggleMenu"
                        />
                    </div>
                </div>
            </div>

            <div class="task_details td-flex td-flex-row td-justify-between">
                <div class="task_comment-amt td-flex td-items-center">
                    <div class="todo-profileImg2 td-flex">
                        <div class="todo-profile profileOne">
                            <img
                                src="../assets/img/collaborators.svg"
                                style="border: 1px solid rgb(1, 216, 146); border-radius: 4px;"
                            />
                        </div>
                    </div>
                    <span
                        class="td-pl-2 td-font-bold td-text-sm td-text-green-500"
                        >{{ getTaskCommentsCount }} comments</span
                    >
                    <span
                        class="td-pl-2 td-text-gray-500 td-text-sm"
                        v-if="getTaskCommentsCount"
                        >Last Comment {{ getCommentTime }}</span
                    >
                </div>
                <div class="task_tag td-flex td-flex-row td-items-center">
                    <div class="td-text-gray-500 td-pr-1">
                        <i class="pi pi-tag"></i
                        ><span
                            class="td-px-2 td-capitalize td-font-bold td-text-sm"
                            >General</span
                        >
                    </div>
                    <div class="td-text-gray-500 td-pr-1">
                        <i class="pi pi-tag"></i
                        ><span
                            class="td-px-2 td-capitalize td-font-bold td-text-sm"
                            >HNG</span
                        >
                    </div>
                    <div class="td-text-blue-500 td-pr-1">
                        <i class="pi pi-calendar"></i
                        ><span class="td-px-2 td-font-bold td-text-sm"
                            >Tomorrow</span
                        >
                    </div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
// import Checkbox from 'primevue/checkbox';
import taskDropdown from "../components/taskDropDown";
import { mapGetters } from "vuex";

export default {
    name: "TaskCard",
    components: {
        // Checkbox,
        taskDropdown
    },

    computed: {
        ...mapGetters({
            getTaskCommentsCount: "comment/getTaskCommentsCount",
            getTaskLastComment: "comment/getTaskLastComment"
        }),

        getCommentTime() {
            const currentTime = Date.now();
            const commentTime = new Date(this.getTaskLastComment());
            const diff = (currentTime - commentTime) / 1000;
            if (diff < 30) return "Now";
            return `${commentTime.getHours()}:${commentTime.getMinutes()}`;
        }
    },

    props: ["task", "index"],
    data() {
        return {
            isModalVisible: false
        };
    },
    methods: {
        toggleMenu() {
            this.isModalVisible = !this.isModalVisible;
        },
        ClickAway() {
            this.isModalVisible = false;
            // this.$emit('toggleMenu')
        }
    }
};
</script>
