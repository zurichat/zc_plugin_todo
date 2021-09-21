<template>
    <div class="overlay">
      <div class="bg-white list_container p-2 rounded ">
      <div class="flex justify-between items-center">
      <h3 class="font-bold text-lg mb-2">Assign Collaborator</h3>
              <div @click="assign">X</div>
      </div>
          
          <div class="input-box">
            <input @input="search()" v-model=value class="rounded w-full border py-2 px-2 hover:border-green-500 outline-none" type="text"/>
          </div>
          <div>
            <label :for="user.name.first" v-for="(user, index) in users" :key="index" class="flex hover:border hover:shadow border-b p-2 my-2 pb-2 items-center"><Checkbox v-model="checked" :id="user.name.first" name="name" :value="user.name['first']" /> <span class="px-2 tracking-wide">{{user.name.first + ' ' + user.name.last}}</span></label>
          </div>
          <button class="px-4 py-2 bg-green-500 text-white rounded shadow" @click="assign">Assign</button>
      </div>
    </div>
</template>
<script>
import Checkbox from 'primevue/checkbox'
import axios from 'axios'
export default {
  name: 'AssignForm',
  data(){
    return {
      checked: [],
      users: [],
      value: ''
      }
  },
    components : {
      Checkbox
    },
    methods: {
      getUser(){
        axios.get('https://randomuser.me/api/?results=15').
        then(response => this.users = (response.data.results))
      },
      search(){
        if(this.value != ''){
            this.users = this.users.filter( user => user.name.first.toLowerCase().indexOf(this.value.toLowerCase()) >= 0)
        }
        
      }
    },
    mounted(){
      this.getUser()
    }
}
</script>
<style>
  .overlay {
     width: 100%;
     display: flex;
     justify-content: center;
     align-items: center;
     position: fixed;
     top: 0;
     bottom: 0;
     left: 0;
     z-index: 2;
      background: rgba(0, 0, 0, 0.14901960784313725);
   }
   .list_container {
     width: 100%;
     overflow-y: scroll;
     max-height: 20em;
      max-width: 30em;
   }
</style>
