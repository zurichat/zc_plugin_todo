<template>
    <div class="edit-label-overlay">
        <div class="edit-label-modal" v-click-away="hideLabel">
            <h3>Edit Labels</h3>
            <div class="create-label">
                <img src="/img/add-icon.png" alt="add-icon" />
                <p>Create a new label</p>
            </div>

            <button class="done" @click="hideLabel">Done</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "EditLabelModal",

    methods: {
        hideLabel() {
            this.$emit("close");
        },
    },
};
</script>

<style scoped>
* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

.edit-label-overlay {
    width: 100%;
    height: 100vh;
    background: rgba(0, 0, 0, 0.18);
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    inset: 0;
    z-index: 5;
}

.edit-label-modal {
    display: flex;
    flex-direction: column;
    padding: 30px;
    background: #ffffff;
    border-radius: 5px;
    height: 300px;
    width: 40%;
}

.edit-label-modal h3 {
    font-weight: 500;
    margin-bottom: 30px;
    font-size: 1.4rem;
}

.create-label {
    display: flex;
    align-items: center;
    cursor: pointer;
}

.create-label img {
    margin-right: 40px;
    width: 20px;
    height: 20px;
}

.create-label p {
    color: #999999;
    font-size: 0.9rem;
}

.done {
    border: 0;
    outline: 0;
    color: #000;
    font-size: 1.1rem;
    margin: auto 0 0 auto;
    background: transparent;
    cursor: pointer;
}

.done:hover {
    color: #00b87c;
}

@media screen and (max-width: 900px) {
    .edit-label-modal {
        width: 60%;
    }
}

@media screen and (max-width: 720px) {
    .edit-label-modal {
        width: 70%;
    }
}

@media screen and (max-width: 600px) {
    .edit-label-modal {
        width: 85%;
    }
}

@media screen and (max-width: 480px) {
    .edit-label-modal {
        width: 95%;
    }
}
</style>
