<template>
    <div class="form-container">
        <form action>
            <h1>Create new task</h1>

            <div class="form-group">
                <label for="topic">Topic</label>
                <input
                    required
                    type="text"
                    id="topic"
                    placeholder="Type task title"
                />
            </div>

            <div class="form-group">
                <label for="desc">Description</label>
                <input
                    required
                    type="text"
                    id="desc"
                    placeholder="Type task description"
                />
            </div>

            <div class="form-group">
                <label for="label">Label</label>
                <select required name="label" id="label">
                    <option value disabled selected>Select task label</option>
                    <option value="1">Sprint</option>
                    <option value="2">Marathon</option>
                    <option value="3">hng-esque task</option>
                </select>
            </div>

            <div class="form-flex">
                <div class="form-group">
                    <label for="start-date">Start</label>
                    <input required type="date" id="start-date" />
                </div>

                <div class="form-group">
                    <label for="end-date">End</label>
                    <input required type="date" id="end-date" />
                </div>
            </div>

            <div class="option">
                <input type="checkbox" />
                <p>Recurring task</p>
            </div>

            <div class="cta-container">
                <button class="cancel" type="button">Cancel</button>
                <button class="submit" type="submit">Create task</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "TaskForm",
};
</script>

<style scoped>
* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

form {
    width: 40%;
    margin: 25px auto;
    padding: 30px 40px;
    background: #fff;
    border-radius: 8px;
}

form h1 {
    font-weight: 600;
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-size: 0.8rem;
    font-weight: 600;
    display: block;
    margin-bottom: 10px;
}

.form-group input,
.form-group select {
    border: 1px solid #dadada;
    border-radius: 4px;
    width: 100%;
    padding: 12px 15px;
}

.form-flex {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.form-flex .form-group {
    width: 48.5%;
    margin-bottom: 0;
}

.option {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
}

.option input {
    width: 20px;
    height: 20px;
    margin-right: 10px;
    cursor: pointer;
}

.option p {
    font-size: 0.85rem;
}

.cta-container {
    display: flex;
    justify-content: flex-end;
}

.cta-container button {
    border: 0;
    outline: 0;
    background: transparent;
    cursor: pointer;
}

.cta-container button.cancel {
    color: #00b87c;
    font-size: 0.75rem;
    margin-right: 30px;
}

.cta-container button.cancel:hover {
    color: #959595;
}

.cta-container button.submit {
    padding: 10px 20px;
    font-size: 0.75rem;
    background: #00b87c;
    color: #fff;
    border-radius: 4px;
    border: 1px solid transparent;
}

.cta-container button.submit:hover {
    border-color: #00b87c;
    background: transparent;
    color: #00b87c;
}

@media screen and (max-width: 900px) {
    form {
        width: 60%;
    }
}

@media screen and (max-width: 720px) {
    form {
        width: 70%;
    }
}

@media screen and (max-width: 600px) {
    form {
        width: 80%;
    }
}

@media screen and (max-width: 480px) {
    form {
        width: 95%;
    }
    form h1 {
        font-size: 0.85rem;
    }
}
</style>
