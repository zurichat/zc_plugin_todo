<template>
    <div class="modal">
        <div class="grid my-2 p-4 overflow-visible text-sm border rounded-md shadow-md modal-items w-60 grid-row-4 h-100">
            <button class="flex mb-2 border content-right mx-right justify-items-end position-absolute btn-close"
                type="button" @click="close">
                x
            </button>
            <h1 class="font-semibold text-lg mb-4">Access Settings</h1>
            <div class="form-group flex">
                <input class="mt-2" v-model="access" type="radio" name="public" id="public">
                <span class="">
                    <label for="public">
                        <p class="label">Public access</p>
                    <p>Available to anyone</p>
                    </label>
                </span>
            </div>
            <div class="form-group flex">
                <input class="mt-2" type="radio" name="private" id="private">
                <span class="">
                    <label for="private">
                        <p class="label">Private access</p>
                    <p>Only available to anyone with the link</p>
                    </label>
                </span>
            </div>
            <div class="form-group flex">
                <input class="mt-2" type="radio" name="organisation" id="organisation">
                <span class="">
                    <label for="private">
                        <p class="label">Organisational access</p>
                    <p>Only available to the organisational Staff</p>
                    </label>
                </span>
            </div>

        </div>
    </div>
</template>

<script scoped>
    export default {
        name: 'modal',
        data() {
            return {
                access: '',
                isShareModalVisible: false,
            };
        },
        methods: {
            close() {
                this.$emit('close');
            },
            showShareModal() {
                this.isShareModalVisible = true;
            },
            closeShareModal() {
                this.isShareModalVisible = false;
            }
        },
    };
</script>

<style scoped>
    .modal-items {
        position: absolute;
        right: -50px;
        z-index: 100;
        overflow: auto;
        overflow-y: auto;
        background-color: white;
    }

    .btn-close {
        position: absolute;
        top: 5px;
        right: 5px;
        border: none;
        font-size: 20px;
        padding: 10px;
        cursor: pointer;
        font-weight: bold;
        color: #4AAE9B;
        background: transparent;
    }

    .form-group {
        margin: 0.5rem;
    }

    .form-group span {
        margin-left: 1rem;
    }

    .form-group input {
        border: 1px solid #dadada;
    }

    .form-group .label {
        font-size: 15px;
        font-weight: 600;
        color: #101010;
    }

    .form-group p {
        font-size: 13px;
        font-weight: 600;
        color: #999999;
    }
</style>