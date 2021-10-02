<template>
    <div class="overlay td-relative">
        <div
            v-if="!getComments.length"
            class="td-flex td-justify-center td-border td-border-red-700 td-absolute td-w-100 td-h-100"
        >
            <img
                src="https://s2.svgbox.net/loaders.svg?ic=slow-spinner&color=70d043"
                width="32"
                height="32"
            />
        </div>

        <div class="comment td-w-2/3 lg:td-w-full" v-if="getComments.length">
            <div class="td-bg-gray-50 td-w-full td-flex td-justify-between">
                <span class="td-px-3 td-py-2">
                    <h2 class="td-text-lg td-font-bold td-text-black-500 title">
                        Comments
                    </h2>
                    <p
                        class="td-text-gray-400 td-pb-1 td-text-sm td-font-medium"
                    >
                        <span class="task_number">{{
                            getCurrentTask.title
                        }}</span>
                    </p>
                </span>
                <div @click="closeModal" class="td-p-2 td-cursor-pointer">
                    <i class="pi pi-times td-text-xl"></i>
                </div>
            </div>
            <div class="td-h-96 td-bg-white td-pt-5">
                <div
                    v-for="(comment, index) in getTaskComments(
                        getCurrentTask.task_id
                    )"
                    :key="index"
                    class="td-place-self-start td-flex td-px-3 td-py-3"
                >
                    <div class="td-self-start td-flex-none td-w-10">
                        <img
                            class="td-mr-1"
                            src="../assets/img/zuri.svg"
                            alt=""
                        />
                    </div>
                    <div class="td-flex td-flex-col">
                        <span class="mx-4 td-flex-grow">
                            <p
                                class="task_title td-text-sm td-font-semibold td-flex td-items-center"
                            >
                                {{ currentUser }}
                                <span
                                    class="time td-ml-5 td-text-gray-700 td-text-xs td-font-normal"
                                    >{{
                                        getCommentTime(comment.created_at)
                                    }}</span
                                >
                            </p>
                            <p
                                class="td-text-sm td-text-gray-700 td-font-light ml-8 td-mt-3"
                            >
                                {{ comment.body }}
                            </p>
                        </span>
                    </div>
                </div>
            </div>
            <!-- <form class=""> -->
            <div class="td-comment-group">
                <textarea
                    v-on:keyup.enter="addComment"
                    v-model="comment"
                    class="td-self-end td-w-full textarea td-pl-2 td-py-2 td-rounded td-w-full td-shadow-lg td-outline-none td-shadow-inner td-pr-7 
														td-border hover:td-border-green-400 td-bg-white"
                    placeholder="Add Comment..."
                ></textarea>

                <button
                    @click.prevent="addComment"
                    class="icon-user"
                    :disabled="!comment.length || commenting"
                >
                    <i class="pi pi-send send-icon"></i>
                </button>
            </div>
            <!-- </form> -->
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import CentrifugeSetup from "../plugins/realtime";

export default {
    name: "CommentBox",

    computed: {
        ...mapGetters({
            User: "todos/user",
            getComments: "comment/getTaskComments",
            allTodos: "todos/allTodos",
            getTaskComments: "comment/getTaskComments",
            getCurrentTask: "comment/getCurrentTask"
        }),

        currentUser() {
            return this.User["0"].user_name;
        },

        currentTodo() {
            return this.allTodos.find(
                todo => todo._id.toLowerCase() === this.$route.params.id
            );
        },

        orgId() {
            return this.User["0"].org_id;
        },

        mockComment() {
            return {
                body: this.comment,
                user_id: this.User["0"]._id,
                org_id: this.orgId,
                task_id: this.getCurrentTask.task_id,
                todo_id: this.currentTodo._id,
                created_at: Date.now()
            };
        },

        getCommentsPayload() {
            return {
                todo_id: this.$route.params.id,
                user_id: this.User["0"]._id,
                org_id: this.orgId
            };
        }
    },

    mounted() {
        let vm = this;

        CentrifugeSetup(vm.currentTodo.channel, vm.updateComment);

        if (!this.getComments.length) this.fetchComments();
    },

    data() {
        return {
            comment: "",
            commenting: false
            // centrifuge: new Centrifuge(
            //     "wss://realtime.zuri.chat/connection/websocket",
            //     { debug: true }
            // )
        };
    },

    methods: {
        ...mapActions({
            fetchTodoComments: "comment/fetchTodoComments",
            newComment: "comment/newComment",
            saveComment: "comment/saveComment"
        }),

        updateComment(comment) {
            this.newComment(comment.data.details.body);
        },

        setUpCentrifugo() {
            let vm = this;
            vm.centrifuge.on("connect", ctx => {
                console.log("centrigo set up on comment section", ctx);
                vm.subscribe(vm.currentTodo.channel, message => {
                    console.log("message from centrifuge", message);
                });
            });
        },

        fetchComments() {
            this.fetchTodoComments(this.getCommentsPayload)
                .then(response => {
                    console.log("comments from server", response);
                })
                .catch(err => {
                    console.log("error getting comments", err);
                });
        },

        closeModal() {
            this.$emit("showComment");
        },

        addComment() {
            this.commenting = true;
            this.newComment(this.mockComment);
            this.saveComment(this.mockComment)
                .then(response => {
                    this.commenting = false;
                    console.log(
                        "response making new comment to server",
                        response
                    );
                })
                .catch(err => {
                    this.commenting = false;
                    console.log("error making this.comments", err);
                });
            this.comment = "";
        },

        getCommentTime(time) {
            const currentTime = Date.now();
            const commentTime = new Date(time);
            const diff = (currentTime - commentTime) / 1000;
            if (diff < 30) return "Now";
            return `${commentTime.getHours()}:${commentTime.getMinutes()}`;
        }
    }
};
</script>
<style scoped>
.td-comment-group {
    position: relative;
    height: 200px;
    width: 100%;
}

.td-comment-group textarea {
    height: 200px;
    width: 100%;
}

.icon-user {
    position: absolute;
    width: 16px;
    height: 16px;
    right: 30px;
    top: 10px;
}

button i.send-icon {
    font-size: 1.6rem;
    color: green;
}

button:disabled i.send-icon {
    color: gray;
}

@media screen and (max-width: 768px) {
    .overlay {
        line-height: 1.46666667;
        align-items: center;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        height: 100%;
        justify-content: center;
        left: 0;
        inset: 0;
        /* opacity: 0; */
        position: fixed;
        top: 0;
        transition: 80ms linear;
        width: 100%;
        z-index: 1012;
    }
}
</style>
