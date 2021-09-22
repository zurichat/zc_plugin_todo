<template>
    <div class="comment-box w-100">
        <div class="td-flex td-items-center td-my-4">
            <p class="dark-grey td-mr-3">Task 1</p>
            <p class="light-grey">Comments</p>
        </div>

        <div
            class="comment td-flex td-items-start td-mb-8"
            v-for="(comment, index) in comments"
            :key="index"
        >
            <div class="avatar td-w-8 td-h-8 td-rounded-md td-mr-4">
                <img
                    src="../assets/img/user_avatar.svg"
                    class="td-w-full td-h-full"
                />
            </div>

            <div class="comment-body td-w-full">
                <div class="comment-meta td-flex td-items-baseline td-mb-1">
                    <p class="text-md font-semibold td-mr-2">
                        {{ comment.author }}
                    </p>
                    <p class="td-text-xs td-font-normal td-uppercase">
                        {{ comment.time }}
                    </p>
                </div>

                <p class="light-grey td-text-sm">
                    {{ comment.comment }}
                </p>
            </div>
        </div>

        <div>
            <textarea
                v-model="comment"
                name=""
                id=""
                cols="30"
                rows="4"
                class="td-w-full td-border td-p-3 td-rounder-sm"
                placeholder="add comment"
                @keyup.enter="updateComment(comment)"
            ></textarea>
        </div>
    </div>

    <!-- this will be fully implemented as soon as the endpoints are ready, thanks -->
</template>
<script>
export default {
    name: "CommentBox",

    data() {
        return {
            comment: "",
            comments: [
                {
                    author: "Rilwan",
                    comment:
                        "Since you are here, you made it to the zuri chat to-do plugin..So do you have a comment about that task in your todo? let's hear about it. Thanks",
                    time: "10:30am"
                },
                {
                    author: "Guest",
                    comment:
                        "Oh thanks..Not much comment from me. Just want to say nice job",
                    time: "10:34am"
                },
                {
                    author: "John doe",
                    comment:
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tellus nunc arcu ornare iaculis. Volutpat tempus egestas donec pretium.",
                    time: "10:40am"
                },
                {
                    author: "Sirius",
                    comment:
                        "John Doe, what language is that, looks like some spell",
                    time: "10:45am"
                }
            ]
        };
    },

    methods: {
        updateComment(comment) {
            const new_comment = {
                author: "Rilwan",
                time: "11:00am",
                comment
            };

            this.comments.push(new_comment);
            this.comment = "";
        }
    }
};
</script>

<style scoped>
.light-grey {
    color: #686363;
}

.dark-grey {
    color: #242424;
}

textarea {
    border: 1px solid #242424;
}
</style>
