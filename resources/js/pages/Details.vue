<template>
    <div>
      {{this.$route.params.id}}
      <div @click="close">X</div>
      {{check()}}
    </div>
</template>
<script>
export default {
    name: 'TodoDetails',
  methods: {
    close(){
      this.$emit('closeComment')
    },
    check(){
      if(this.$route.params.id){
        this.$emit('showComment')
      } else {
        this.$emit('closeComment')
      }
    },
    
  },
  mounted(){
      this.check();
    }
}
</script>
