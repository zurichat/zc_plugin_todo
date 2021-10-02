<template>
    <div class="overlay">
        <div
            @submit.prevent="setReminder"
            v-click-away="ClickAway"
            class="td-w-4/5 td-flex td-flex-col td-justify-center  td-sm:w-6/12 td-p-4 td-bg-white td-rounded "
        >
            <div>
                <div>
                    <h1>Reminder</h1>
                <p>West Central Africa</p>
                </div>

                <div>
                    <p><b>Due date</b></p>
                    <input type="date" class="date-input">
                </div>
            </div>
           
        </div>
    </div>
</template>

<script>
export default {
    name: "RemainerModal",
    data() {
        return {};
    },
    computed: {
        //function to get user object from vuex store
       
    },
    methods: {
        ClickAway() {
            this.$emit('toggleReminderModal')
        },
        setReminder(){
            
        }
    },
    mounted(){
        const dateInput = document.querySelector('.date-input');
        console.log(dateInput.value);
    }
   
};
</script>

<style lang="scss" scoped>
//   * {
//     margin: 0;
//     box-sizing: border-box;
//   }

.overlay {
    line-height: 1.46666667;
    align-items: center;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    height: 100%;
    justify-content: center;
    left: 0;
    // opacity: 0;
    position: fixed;
    top: 0;
    transition: 80ms linear;
    width: 100%;
    z-index: 1012;
}
</style>
