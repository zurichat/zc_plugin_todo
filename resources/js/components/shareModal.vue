<template>
    <div class="overlay">
        <form @submit.prevent="addTodo" class="sm:my-4 p-4 sm:p-6">
            <div class="flex flex-row justify-between mb-4 items-center">
                <div class="flex">
                    <h1 class="font-bold text-2xl mr-8 self-center">Share</h1>
                    <div class="relative" v-click-away="ClickAway">
                            <span class="private-btn flex items-center rounded-sm text-white p-3" @click="showPrivateModal">
                                    Private Access
                                </span>
                        <privateModal v-show="isModalVisible" @close="closePrivateModal" />
                    </div>
                            
                </div>
                <button class="flex mb-2 border content-right mx-right justify-items-end position-absolute btn-close"
                type="button" @click="closeModal" >
                x
            </button>
            </div>
            

            <div class="form-group mb-10">
                <label class="font-bold text-md" for="link">Link to share</label>
                <div class="lock-container">
                    <input v-model='shareDetails.link' required type="text" id="link"
                        class="border bg-white rounded-md outline-none h-12 text-md w-full pl-10 pr-2"
                        placeholder="https :// htywyGAFS K.GFGSSGJDGSDJsjkJSzkLZKLCHZNMz<xZO/ZURICHAT" />
                    <span class="lock-icon">
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.02835 8.91106C2.02835 8.23344 2.57766 7.68413 3.25528 7.68413H12.9721C13.6497 7.68413 14.199 8.23344 14.199 8.91106V14.1414C14.199 14.819 13.6497 15.3683 12.9721 15.3683H3.25528C2.57766 15.3683 2.02835 14.819 2.02835 14.1414V8.91106Z"
                                stroke="#00B87C" stroke-width="1.22693" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M4.73294 7.68409V4.88985C4.73294 2.96083 6.24655 1.39705 8.11368 1.39705C9.98082 1.39705 11.4944 2.96083 11.4944 4.88985V7.68409"
                                stroke="#00B87C" stroke-width="1.22693" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </div>
                <button class="link-btn flex items-center rounded-sm p-2">Copy Link</button>
            </div>

            <div class="line my-20"></div>

            <div class="form-group">
                <label class="font-bold text-md mt-10" for="invite">Invite People</label>
                <input v-model='shareDetails.email' required type="text" id="invite"
                    class="border bg-white h-12 rounded-md outline-none ///text-md w-full px-2"
                    placeholder="Add multiple Email addresses seperated by commas" />
                <button class="link-btn flex items-center rounded-sm p-2">Copy Link</button>
            </div>
        </form>
    </div>
</template>

<script>
    import { mapActions } from "vuex";
    import { mapGetters } from "vuex";
    import privateModal from './privateModal'
    export default {
        name: "shareModal",
        components: {
            privateModal,
        },
        data() {
            return {
                isModalVisible: false,
                shareDetails: {
                    link: "",
                    email: "",
                },
            };
        },
        computed: {
            //function to get user object from vuex store
            ...mapGetters({
                user: "user/user",
            }),
        },
        methods: {
            ClickAway(event){
            this.isModalVisible = false;
        },
            ...mapActions({
                createTask: "todos/createTask",
            }),
            showPrivateModal() {
                this.isModalVisible = true;
            },
            closePrivateModal() {
                this.isModalVisible = false;
            },
            closeModal() {
                console.log("hgey");
                this.$emit("toggleShareModal");
            },
            addTodo() {
                this.todoDetails.userId = this.user.userId;
                //console.log(this.todoDetails);
                //   function to toggle modal in the main page
                this.$emit("toggleModal");
                //   function to call action in the vuex store 
                this.createTask(this.todoDetails);
            },
        },
    };
</script>

<style lang="scss" scoped>
    .overlay {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 2;
    }

    form {
        width: 60%;
        margin: 25px auto;
        background: #fff;
        border-radius: 8px;
    }

    .private-btn {
        background-color: #2F80ED;
    }

    .form-group label {
        font-size: 0.8rem;
        font-weight: 600;
        display: block;
        margin-bottom: 10px;
    }

    .lock-container {
        position: relative;
    }

    .lock-icon {
        position: absolute;
        top: 15px;
        left:10px;
    }

    .line {
        background-color: #DADADA;
        width: 100%;
        height: 1px;
        margin-top: 1rem;
        margin-bottom: 4px;
    }

    .link-btn {
        color: #2F80ED;
        margin-left: auto;
        margin-top: 1rem;
        border: 1px solid #2F80ED;
    }

    
        .overlay {
            background: rgba(0, 0, 0, 0.14901960784313725);
        }
    


    @media screen and (max-width: 768px) {
        form {
            width: 90%;
            margin: 0 auto;
        }
    }
</style>