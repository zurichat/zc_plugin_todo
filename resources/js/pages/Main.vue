<!---<template>
    <div>
        <h3>
            This is where we will be workinng
        </h3>
    </div>
    
</template>--->
<template>
    <div>
   <TodoDetails />
   </div>
    
</template>

<script>
import TodoDetails from "./TodoDetails.vue"
export default {
    components: {TodoDetails},
    name: 'Main'
}

</script>
