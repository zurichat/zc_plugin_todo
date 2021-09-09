<template>
<div class="w-full">
    <div class="flex flex-row justify-between items-center"> 
      {{this.$route.params.id}}
      <div @click="close" class="font-bold text-green-500">X</div>
      </div>
      <p class="text-green-500 font-bold ">
        This is the todo details section,
        
      </p>
      <p class="text-lg font-bold text-wrap text-red-500">Still under construction</p>
      <!-- <div>
        <div>
          <p>Task Title</p>
        <span>Created On: 12/03348n/39424</span>
        <p>oihsoiv hwt0pu;n4wy0iohjgwklef</p>
        </div>
        <div>
          <p>Task Title</p>
          <div>
            
          </div>
        </div>
        <div class="flex">
          <div>
            <p>Due Date</p>
            <span>p320409</span>
          </div>
          <div>
            <p>Worked </p>
            <span>loiwheot</span>
          </div>
        </div>
      </div> -->
      <TextArea />
    </div>
   
</template>
<script>
import TextArea from '../components/TextArea.vue'
import CommentBox from '../components/CommentBox.vue'
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
    components: {
      TextArea
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
