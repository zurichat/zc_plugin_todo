<template>
    <div>
      {{this.$route.params.id}}
      <div @click="close">X</div>
      
    </div>
</template>
<script>
import {mapGetters} from 'vuex'
export default {
    name: 'TodoDetails',
    data(){
      return {
        selectedTodo: ''
      }
    },
        computed: {
      ...mapGetters({
        allTodos: 'todos/allTodos'
      })
    },
  methods: {
    close(){
      this.$emit('hideComment')
    },
    check(){
      let id = this.$route.params.id
      this.selectedTodo = this.allTodos.find( todo => todo.card_id.toLowerCase() === (id.toLowerCase()));
       if(this.selectedTodo <= 0 || this.selectedTodo === undefined){
         this.$emit('hideComment')
         this.$router.push({path: '/main'})
         
       }
       else {
       }
      console.log(this.selectedTodo)
    },
    
  },
  mounted(){
      this.check();
    }
}
</script>
