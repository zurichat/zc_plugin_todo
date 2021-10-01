<template>
    <div
        id="TodoCard"
        class="td-px-4 td-py-2 td-mx-auto hover:td-border td-cursor-pointer td-my-4 sm:td-my-0 taskcard sm:td-mx-0 td-relative"
    >
        <div id="todo_title" class="td-flex td-items-center td-justify-between">
            <p class="title td-font-bold  td-capitalize">Title</p>
            <div>
                <i class="pi pi-ellipsis-v"></i>
            </div>
        </div>
        <p id="description" class="td-text-gray-400 td-font-bold td-text-sm">Description</p>
        <hr class="td-mt-4 td-mb-2"/>
        <div id="progress_container" >
            <progress
                id="progress"
                class="td-w-full td-mx-auto"
                value="50"
                max="100"
            >
                32%
            </progress>
            <div id="task_preview" class="td-flex td-items-center ">
                <div class="mark_icon">
                    <svg
                        width="20"
                        height="20"
                        viewBox="0 0 20 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M6.39199 1.66656H13.617C16.442 1.66656 18.3336 3.6499 18.3336 6.5999V13.4091C18.3336 16.3499 16.442 18.3332 13.617 18.3332H6.39199C3.56699 18.3332 1.66699 16.3499 1.66699 13.4091V6.5999C1.66699 3.6499 3.56699 1.66656 6.39199 1.66656ZM9.52531 12.4916L13.4836 8.53325C13.767 8.2499 13.767 7.79157 13.4836 7.4999C13.2003 7.21657 12.7336 7.21657 12.4503 7.4999L9.00864 10.9416L7.55032 9.48325C7.26699 9.19992 6.80033 9.19992 6.51699 9.48325C6.23366 9.76658 6.23366 10.2249 6.51699 10.5166L8.50031 12.4916C8.64198 12.6332 8.82531 12.6999 9.00864 12.6999C9.20031 12.6999 9.38364 12.6332 9.52531 12.4916Z"
                            fill="#999999"
                        ></path>
                    </svg>
                </div>
                <p id="details" class="td-flex td-px-2 td-items-center td-text-gray-400  td-text-sm">5/10 tasks (50% Completed)</p>
            </div>
        </div>
        <div id="date_container" class="td-flex td-my-2 td-items-center">
            <div id="todo_date" class="td-flex td-items-center td-text-gray-400  td-text-xs">
                <i class="pi pi-calendar"></i>
                <span class="td-px-1">Sept 20, 2021</span>
            </div>
            <div class="td-text-center">
                <span class="td-text-green-500 td-bg-green-200 td-h-5 td-rounded td-px-2 td-py-1 td-text-xs td-select-none">
                    20 days left
                </span>
            </div>
            <span class="td-text-xs"></span>
        </div>
        <div class="td-flex td-justify-between td-mt-4 td-items-center">
            <div id = "collaborators" class="td-flex td-items-center">
                <img src="../assets/img/collaborators.svg" />
                <span
                    class="td-text-white td-mx-0.5 td-bg-green-500 td-h-6 td-rounded td-px-2 td-py-1 td-text-xs td-select-none"
                   >20</span
                 >
            </div>
            <div id="todo_link">
                <span class="td-text-underline">View Task</span>
            </div>      
        </div>
    </div>
</template>
<script>
export default {};
</script>
<style lang="scss" scoped>
#TodoCard {
    background: #ffffff;
    // border: 1px solid #dadada;
    box-sizing: border-box;
    border-radius: 0.6em;
    max-width: 30em;
    box-shadow: 0px 0px 15px #e7e7e7de;
}
progress[value] {
  /* Reset the default appearance */
  -webkit-appearance: none;
   appearance: none;
  border-radius: .6em;
  height: 5px;
  //  box-shadow: 0 0 10px rgb(0 103 69 / 28%);
}
progress[value]::-webkit-progress-bar {
 
  border-radius: 2px;
  background-color: #E2ECF8;
}
progress[value]::-webkit-progress-value {
  background-color: #00B87C;
  border-radius: 2px;
}

#progress{
  height: .5rem;
  border-radius: 4px;
}
</style>
