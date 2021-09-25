<template>
    <div class="empty">
        <p class="td-text-gray-300 td-font-bold  td-text-lg md:td-text-xl  td-text-center ">
            {{ title }}
        </p>
        <div class="image td-my-4">
            <img src="../assets/img/BigTrash.svg" />
            <span
                class="td-text-gray-300 td-font-bold  td-text-md md:td-text-lg  td-text-center"
                >{{ subtitle }}</span
            >
        </div>
    </div>
</template>
<script>
export default {
    name: "Empty",
    props: {
        title: {
            type: String
        },
        subtitle: {
            type: String
        }
    }
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
