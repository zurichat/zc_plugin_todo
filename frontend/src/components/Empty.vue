<template>
    <div class="empty">
        <p class="td-text-gray-300 td-font-bold  td-text-lg md:td-text-xl  td-text-center ">
            {{ title }}
        </p>
        <div class="image td-my-4">
            <img src="../assets/img/BigTrash.svg" />
            <span
                class="td-text-gray-600  td-text-sm md:td-text-md  td-text-center"
                >You have no {{ subtitle }} yet. Click on the button below to <br /> add your first one. To-do list created will appear here.</span
            >
        </div>
        <button class="td-border td-border-green-500 td-px-3 td-flex td-items-center td-rounded td-py-2 td-text-green-500">
             <svg
            width="18"
            height="18"
            viewBox="0 0 18 18"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M9 3.74994V14.2499"
                stroke="#00B87C"
                stroke-width="1.22693"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
            <path
                d="M3.74988 8.99994H14.2499"
                stroke="#00B87C"
                stroke-width="1.22693"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
        </svg>
        Create a {{ subtitle }}
        </button>
    </div>
</template>
<script>
export default {
  name: 'Empty',
  props: {
    title: {
      type: String,
    },
    subtitle: {
      type: String,
    },
  },
};
</script>
<style lang="scss" scoped>
.empty {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: 60vh;
}
.image {
    border-radius: 0px;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
}
</style>
