<template>
    <div class="comment td-flex td-items-start td-mb-8">
        <div class="avatar td-w-8 td-h-8 td-rounded-md td-mr-4">
            <img
                src="https://images.unsplash.com/photo-1633113089631-6456cccaadad?ixid=MnwxMjA3fDF8MHxlZGl0b3JpYWwtZmVlZHw2fHx8ZW58MHx8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=60"
                class="td-w-full td-h-full"
            />
        </div>

        <div class="comment-body td-w-full">
            <div class="comment-meta td-flex td-items-baseline td-mb-1">
                <p class="text-md font-semibold td-mr-2">
                    Rilwan
                </p>
                <p class="td-text-xs td-font-normal td-uppercase">
                    12:00pm
                </p>
            </div>

            <p class="light-grey td-text-sm">
                testing testing
            </p>
        </div>
    </div>
</template>

<script>
export default {
    name: "MessageBlock"
};
</script>

<style scoped>
.light-grey {
    color: #686363;
}

.dark-grey {
    color: #242424;
}
</style>
