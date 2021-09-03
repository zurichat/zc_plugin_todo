<template>
    <div>
        <h3>
            This is where we will be working
        </h3>
        <taskCard title="Task title" date="Tomorrow" description="Description" />
    </div>
</template>
<script>
<<<<<<< HEAD
export default {
    import dayjs from "dayjs";
import "style.css";
import "calendar.js";
}
</script>"

<script>
export default {
    name: 'Main'
}
</script>
=======
    import taskCard from '../components/taskCard.vue'
    export default {
        name: 'Main',
        components: {
            taskCard
        }
    }
</script>
>>>>>>> 3e1d65dd14517e66c3fd1fef665e389df7d4f054
