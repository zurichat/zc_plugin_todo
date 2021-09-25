<template>
  <div>
    <router-view />
  </div>
</template>

<script>
 let { GetUserInfo } = import (/* webpackIgnore: true */ "@zuri/zuri-control");
export default {
  name: 'App',
  components: {
    
  },
   methods: {
      async auth(){
         GetUserInfo();
       }
   },
     mounted(){
         this.auth()
  }
}
</script>

<style>

@import './assets/styles/app.css';
@import url('https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap');
body {
  font-family: 'Lato', sans-serif;
  -webkit-font-smoothing: antialiased;
}
</style>
