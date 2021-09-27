<template>
  <div>
    <router-view />
  </div>
</template>

<script>
import { GetUserInfo } from "zuricontrol"
// import Centrifuge from 'centrifuge'
import { mapActions } from "vuex";
// let { GetUserInfo } = import ( "zuricontrol");
export default {
  name: 'App',
  data(){
    return  {
      user: null,
        centrifuge : null
        }
  },
  components: { },
   methods: {
      ...mapActions({
        getAllTodos: "todos/getAllTodos",
        add_user : 'todos/ADD_USER'
      }),
       async auth(){
         console.log('auth()')
           await GetUserInfo().then((res)=>{
             this.user = res.data;
             this.add_user(this.user)
             this.getAllTodos();
         }).catch((error)=>{
           console.log(error)
         })
          
          
        },
      //  callCentrifugo(){
      //             console.log('i say i wan sleep');
      //       this.centrifuge = new Centrifuge('wss://realtime.zuri.chat/connection/websocket', {debug: true});
      //       // this.centrifuge.setToken('token');
      //       console.log('i go to this place');
      //       this.centrifuge.on("connect", (ctx) => {
      //          console.log("connected", ctx);
      //           this.centrifuge.subscribe("common-room", function(message) {
      //         // check if auth user id is same a subscriber id
      //           if (message.data.subscriberId == 2) {
      //               console.log(2);

      //               this.centrifuge.subscribe(message.data.details.channel, function(ctx) {
      //                   // handle new message coming from channel "news"
      //                   console.log(ctx.data);
      //               });
      //           }

      //         });
      //    });
      //    this.centrifuge.connect();
      // }
   },
     mounted(){
         this.auth()
        //  this.callCentrifugo()
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
