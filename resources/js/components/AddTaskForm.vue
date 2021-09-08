<template>
    <div>
        <form>

            <div class="input_box">
                <label for="topic">Topic</label>
                <input id="topic" name="topic" type="text">
            </div>
            <div class="input_box">
                <label for="description">Description</label>
                <input id="description" name="description" type="text">
            </div>
            <div class="input_box">
                <label for="label">Label</label>
                <input id="label" name="label" type="text">
            </div>
            <div class="input_box grid grid-cols-2">
                <div class="mini_input_box">
                    <label for="start">Start</label>
                   <input id="start" name="start" type="text">
                </div>
                <div class="mini_input_box">
                    <label for="name">Name</label>
                   <input id="name" name="name" type="text">
                </div>
            </div>
            <div class="action_buttons">
                <button>Cancel</button>
                <button>Add Task</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    name: 'AddTaskForm'
}
</script>
