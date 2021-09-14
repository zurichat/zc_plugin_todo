<template>
  <!-- view for all pages -->
  <div id="view_section">
    <!-- the todo nav component -->
    <div>
      <!-- <TodoNav @showLabel="showEditModal = true" /> -->
      <router-view />
    </div>
  </div>
</template>
<script>
import links from './plugins/links.js'
export default {
  name: 'view',
  data(){
    return {
      
    }
  },
  methods:{
    appendLinks(){
      const head = document.querySelector('head');
      
      console.log(links)
      for(let obj of links){
        var link = document.createElement('link');
        link.type = obj.type;
        link.rel = obj.rel;
        head.appendChild(link)
        link.href = obj.href;
        console.log(link)
      }
      
    }
  },
  beforeMount(){
    this.appendLinks()
  }
}
</script>

<style lang='scss'>
#view_section {
   // display: flex;
   font-family: 'Lato', sans-serif !important;
}

@media (min-width: 786px) {
    #view_section {
       // padding: 0 2rem;
    }
}

#comment {
    min-height: 100vh;
    width: 100%;
    border-left: 0.5px solid lightgrey;
}

@media (min-width: 768px) {
    #comment {
        width: 25%;
    }
}

// #comment.hide {
//   display: none
// }

// #comment.show {
//   display: block
// }

@media (max-width: 768px) {
    .hide {
        display: none;
    }

    #view_section {
        display: block !important;
    }

}
</style>
