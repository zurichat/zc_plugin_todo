<template>
    <div class="td-w-full td-flex-grow ">
        <div id="Details" class="">
            <div class="todo-nav td-px-4 td-bg-green-500 td-flex td-justify-between td-items-center">
                <div class="td-flex td-items-center">
                    <h1 class="td-px-2 td-py-2 td-text-white td-text-2xl">
                        # To-do-list
                    </h1>
                    <span class="btn"><i class="pi td-px-
      td-text-white pi-chevron-down" /></span>
                </div>

                <div class="td-flex td-items-center"></div>
            </div>
            <div class="header td-px-2 td-py-4 td-flex td-justify-between td-items-center td-border-b-2">
                <div>
                    <h2 class="td-text-xl td-font-bold td-text-black-500 title">
                        {{ selectedTodo.title }}
                    </h2>
                    <div class="description ">
                        <span>{{ selectedTodo.description }}</span>
                    </div>
                </div>
                <div class="td-flex td-flex-row td-items-center">
                    <!-- <div class="todo-headerRight">
          <a class="commentIcon"><img src="/img/Rectangle 892.png" alt="reply"></a>
          <div class="todo-profileImg td-flex td-items-center">
            <div class="todo-profile profileOne">
              <img src="../assets/img/collaborators.svg" style="border: 1px solid rgb(1, 216, 146); border-radius: 4px;">
            </div>
            
            <p class="text-300">{{ Collaborators }}</p>
          </div>
        </div> -->

                    <div class="" @click="
                            () => {
                                this.$router.push({ name: 'Main' });
                            }
                        ">
                        <p class="td-underline td-text-green-400">
                            Return to To-do list
                        </p>
                    </div>
                </div>
            </div>
            <div class="sub-header td-px-2 td-flex td-py-3 td-justify-between td-items-center td-border-b-2">
                <div class="td-flex td-items-center">
                    <p class="td-font-bold">Tasks</p>

                </div>
                <div class="td-flex td-items-center">
                    <div class="mr-2 font-bold button td-mx-4 td-cursor-pointer td-rounded " @click="isModal = true">
                        + Add a new Task
                    </div>
                    <div class="td-relative td-mx-4 td-cursor-pointer " v-click-away="ClickAway">
                        <span @click="assign()" class="td-justify-center td-flex td-items-center "><i
                                class="pi pi-user-plus td-cursor-pointer td-px-1" /> Add collaborator</span>
                        <!-- <div v-if="isAssign"
                            class="user_dropdown td-absolute td-p-2 td-bg-white td-rounded td-shadow td-border td-mt-12 td-top-0 td-right-0">
                            <input @input="search()" v-model=value
                                class="td-rounded td-border-green-300 td-mx-auto td-w-11/12 td-border td-py-2 td-px-2 hover:td-border-green-500 td-outline-none"
                                type="text" />
                            <div class="td-h-64 td-w-64 td-overflow-y-scroll">
                                <label @click="assign()" :for="user.name.first" v-for="(user, index) in users"
                                    :key="index"
                                    class="td-flex hover:td-border td-text-gray-500 hover:td-text-white hover:td-bg-green-500 td-border-b td-p-2 td-my-2 td-pb-2 td-items-center">
                                    <span class="tracking-wide td-px-2 td-font-bold">{{user.name.first + ' ' +
                                        user.name.last}}</span></label>
                            </div>
                        </div> -->
                        <collabModal v-if="isAssign" @assign="assign"/> 
                    </div>

                    <div class="amt_completed td-ml-4 td-flex td-items-center td-bg-green-100 td-rounded ">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10.9999 1.82458H4.99988C4.17145 1.82458 3.49988 2.49616 3.49988 3.32459V15.3246C3.49988 16.153 4.17145 16.8246 4.99988 16.8246H13.9999C14.8283 16.8246 15.4999 16.153 15.4999 15.3246V6.32459L10.9999 1.82458Z"
                                stroke="#242424" stroke-width="1.22693" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M10.9999 1.82458V6.32459H15.4999" stroke="#242424" stroke-width="1.22693"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12.4999 10.0747H6.49988" stroke="#242424" stroke-width="1.22693"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12.4999 13.0747H6.49988" stroke="#242424" stroke-width="1.22693"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7.99988 7.07458H7.24988H6.49988" stroke="#242424" stroke-width="1.22693"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <span class="td-font-bold ">{{ itemsTodo.length }} completed</span>
                    </div>
                    <div 
          @click="admin()"
            class="mr-2 font-bold button td-mx-4 td-cursor-pointer td-rounded td-flex"
          >
            <svg
              width="18"
              height="18"
              viewBox="0 0 18 18"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M12 15.75V14.25C12 12.5931 10.6569 11.25 9 11.25H3.75C2.09315 11.25 0.75 12.5931 0.75 14.25V15.75"
                stroke="#1D1C1D"
                stroke-width="1.22693"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M6.375 8.25C8.03185 8.25 9.375 6.90685 9.375 5.25C9.375 3.59315 8.03185 2.25 6.375 2.25C4.71815 2.25 3.375 3.59315 3.375 5.25C3.375 6.90685 4.71815 8.25 6.375 8.25Z"
                stroke="#1D1C1D"
                stroke-width="1.22693"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M15 6V10.5"
                stroke="#1D1C1D"
                stroke-width="1.22693"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M17.25 8.25H12.75"
                stroke="#1D1C1D"
                stroke-width="1.22693"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Admin({{collaboratorCount}})</span>
          </div>
                    <!-- <div class="progress_container td-flex td-flex-col">
                    <span
                        class="progress_text td-self-end td-text-sm td-font-medium "
                        >{{ percent }}/100%</span
                    >
                    <progress
                        id="progress"
                        class="td-w-full td-mx-auto"
                        :value="percent"
                        max="100"
                    >
                        32%
                    </progress>
                </div>-->
                </div>

            </div>


            <div class="tasks_container td-px-2 td-py-4 ">
                <div class="td-flex-grow td-my-4 td-px-2 tabMenu">
                    <span class="task_head td-font-bold td-mr-4 td-my-4 td-text-green-500"
                        @click="isSelect('1')">Pending</span>
                    <span class="ml-8 task_head td-my-4 td-font-bold" @click="isSelect('2')">Completed</span>

                    <div class="td-flex ">
                        <div class="tabContents td-flex-grow">
                            <template id="task_container" v-if="selectedTodo.tasks.length <= 0">
                                <div>
                                    <Empty :title="'Oops Your Have no tasks yet'"
                                        :subtitle="'Click Create Task Button'" />
                                </div>
                            </template>

                            <template v-else>
                                <TaskCard :task="task" :todo="selectedTodo" :index="index" @showComment="showComment"
                                    v-for="(task, index) in selectedTodo.tasks" :key="index" />
                            </template>
                        </div>
                        <div v-show="isComment" id="Comment"
                            class="td-hidden lg:td-block td-rounded-md td-flex-shrink-0 td-w-1/4 td-border td-flex td-flex-col">
                            <Comment class="td-rounded-md" @showComment="showComment"
                                :selectedTodo="selectedTodo.title" />
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <transition name="fade">
            <TaskForm v-if="isModal" @createTask="createTask" @toggleModal="toggleModal" />
        </transition>
        <transition name="fade" class="td-block lg:td-hidden">
            <Comment class="td-rounded-md" v-if="isComment" @showComment="showComment"
                :selectedTodo="selectedTodo.title" />
        </transition>
    </div>
</template>
<script>
    import CentrifugeSetup from '../plugins/realtime'
    import TaskForm from '../components/TaskForm';
    import Empty from '../components/Empty'
    import TaskCard from '../components/TaskCard2';
    import collabModal from '../components/collaborators/collaboratorModal.vue'
    import axios from 'axios'
    import Comment from '../components/comment.vue'
    import { mapGetters } from 'vuex'
import { mapActions } from "vuex";

    export default {
        name: 'TodoDetails',
        data() {
            return {
                isActive: '1',
                // centrifuge: null,
                isComment: false,
                checked: [],
                isModal: false,
                selectedTodo: null,
                isAssign: false,
                alltasks: ['', '', '', '', '', '', '', '', '', ''],
                users: [],
                value: '',
                 //selectedCollaborator: null,
                 collaboratorCount: 0
            }
        },
        computed: {
            ...mapGetters({
                allTodos: 'todos/allTodos',
                isUser: 'todos/user',
                centrifuge: 'todos/centrifuge'
            }),
            collaborators() {
                let value = "";
                if (this.todo.colaborators === undefined) {
                    value = this.todo.collaborators.length;
                } else {
                    value = this.todo.colaborators.length;
                }
                return value;
            },
            percent() {
                return (this.checked.length / this.alltasks.length) * 100
            },
            itemsTodo() {
                return this.checked.filter(todo => !todo.completed)
            }
        },
        components: {
            TaskCard,
            TaskForm,
            Empty,
            Comment,
            collabModal
        },
        methods: {
             ...mapActions({
                selectTodo: 'todos/selectedTodo'
             }),
            toggleModal() {
                this.isModal = !this.isModal;
            },
            isSelect: function (num) {
                this.isActive = (num);
            },
            close() {
                this.$emit('hideComment')
            },
            ClickAway() {
                this.isAssign = false
            },
            showComment() {
                this.isComment = !this.isComment
            },
            async createTask(data) {
                const todo_id = this.selectedTodo._id;
                const org_id = this.isUser["0"].org_id
                //this.isUser.Organizations[0];
                await axios.put(`/add-task/${todo_id}?organisation_id=${org_id}`, data)
                    .then((response) => console.log('task created', response))
                    .catch((error) => {
                        if (error.response) {
                            // The request was made and the server responded with a status code
                            // that falls out of the range of 2xx
                            console.warn(error.response.data);
                        } else if (error.request) {
                            // The request was made but no response was received
                            console.log(error.request);
                        } else {
                            // Something happened in setting up the request that triggered the Error
                            console.log('Error', error.message);
                        }
                        console.log(error.config)
                    })
            }
            ,
            assign() {
            this.isAssign = !this.isAssign
            // this.activeTodo(this.selectedTodo._id)
            this.selectTodo(this.selectedTodo) 
            },
            checkAction(ctx) {
                const _this = this
                // check if auth user id is same a subscriber id
                console.log(ctx.data);
                switch (ctx.data.action) {
                    case "create": {
                        console.log(ctx.data.details)
                        _this.selectedTodo = ctx.data.details
                    } break;
                    case "delete": {
                        const _task = ctx.data.details;
                        console.log(ctx.data.details);
                        let location = _this.selectedTodo.tasks.findIndex(task => task.task_id.toLowerCase() === (_task.task_id.toLowerCase()));
                        _this.selectedTodo.tasks.splice(location, 1);
                    } break;
                    // case "assign":
        //   {
        //         _this.selectedCollaborator = ctx.data.details.collaborators;
        //           _this.collaboratorCount ++
        //    }
                    default:
                }
            },
            check() {
                let id = this.$route.params.id
                const _this = this;
                this.selectedTodo = this.allTodos.find(todo => todo._id.toLowerCase() === (id.toLowerCase()));
                if (this.selectedTodo <= 0 || this.selectedTodo === undefined) {
                    this.$router.push({ path: '/' })
                }
                else {
                    CentrifugeSetup(_this.selectedTodo.channel, this.checkAction)
                }
                console.log(this.selectedTodo)
            },
            getUser() {
                axios.get('https://randomuser.me/api/?results=15').
                    then(response => this.users = (response.data.results))
            },
        },
        mounted() {
            this.getUser()
        },
        beforeMount() {
            this.check();
        }
    }
</script>
<style lang="scss" scoped>
    .description {
        color: #616061;
    }
    progress[value] {
        /* Reset the default appearance */
        -webkit-appearance: none;
        appearance: none;
        border-radius: 0.6em;
        height: 5px;
        //  box-shadow: 0 0 10px rgb(0 103 69 / 28%);
    }
    progress[value]::-webkit-progress-bar {
        border-radius: 2px;
        background-color: #e2ecf8;
    }
    progress[value]::-webkit-progress-value {
        background-color: #00b87c;
        border-radius: 2px;
    }
    #progress_container {
        min-width: 15em;
    }
    #progress {
        height: 1.1rem;
        border-radius: 4px;
    }
    .todo-profileImg {
        position: relative;
        background: #fff;
        border: 1px solid #f6f6f6;
        border-radius: 4px;
        width: 105px;
        height: 30px;
    }
    .todo-profileImg2 {
        position: relative;
        background: #fff;
        border-radius: 4px;
        width: 105px;
        height: 30px;
    }
    .todo-profile.profileOne {
        left: 2%;
        z-index: 1000;
    }
    .todo-profile {
        position: absolute;
        border-radius: 4px;
        top: 7%;
    }
    .todo-profile.profileTwo {
        left: 19%;
        z-index: 500;
    }
    .todo-profile.profileThree {
        left: 35%;
    }
    .text-300 {
        position: absolute;
        top: 18%;
        right: 5%;
        font-size: 16px;
        font-weight: bold;
        z-index: 100;
        color: #000;
    }
    .tabMenu span {
        cursor: pointer;
    }
    a.router-link-exact-active {
        color: #00b87c;
    }
</style>
