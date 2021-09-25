<template>
    <button
        class="td-bg-green-500 td-my-5 td-flex td-items-center td-p-4 td-rounded-md td-text-white"
    >
        <svg
            width="18"
            height="18"
            viewBox="0 0 18 18"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M9 3.74994V14.2499"
                stroke="white"
                stroke-width="1.22693"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
            <path
                d="M3.74988 8.99994H14.2499"
                stroke="white"
                stroke-width="1.22693"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
        </svg>
        <span class="td-px-2">Create New Todo</span>
    </button>
</template>
<script>
export default {
    name: "AddTaskBtn"
};
</script>
<style lang="scss" scoped>
button {
    box-shadow: 0 0 10px rgb(0 103 69 / 28%);
}
</style>
