<template>
  <div>
    <router-view />
  </div>
</template>

<script>
import {getLoggedInUser} from "./plugins/auth"
// import {getAllTodos} from './plugins/xhr'
import Centrifuge from 'centrifuge'
import { mapActions } from "vuex";
import {mapGetters} from 'vuex';
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
  computed:  {
    ...mapGetters({
      isUser: "todos/user"
    })
  },
   methods: {
      ...mapActions({
        HandleAllTodos: "todos/HandleGetTodos",
        add_user : 'todos/ADD_USER',
        addTodo : 'todos/centrifugeAddTodo'
      }),
        async welcome(){
              // let todos;
              this.user = getLoggedInUser()
              // const user_id = this.user["0"]._id;
              // const org_id = this.user["0"].org_id;
              this.add_user(this.user)
              this.HandleAllTodos()
              //.then(todo => console.log(todo)).catch(err => console.log(err)) 
            //   todos = new Promise(resolve => setTimeout(() => resolve("done"), 1000))
            //  const ptodos = async () => {
            //           const a = await todos;
            //           console.log(a);
            //         };
              //console.log(todos)
              // this.addTodo(todos)
               
              }, 
        callCentrifugo(){
                   console.log('i say i wan sleep');
                   const _this = this
             this.centrifuge = new Centrifuge('wss://realtime.zuri.chat/connection/websocket', {debug: true});
             // this.centrifuge.setToken('token');
             console.log('_this.isUser');
             this.centrifuge.on("connect", (ctx) => {
                console.log("connected", ctx);
                 this.centrifuge.subscribe("common-room", function(message) {
               // check if auth user id is same a subscriber id
                 if (message.data.subscriberId === _this.isUser["0"]._id) {
                    //  console.log(2);
                        _this.addTodo(message.data.details)
                        console.log('hello its centrifugo');
                        console.log(message.data.details);
                    //  this.centrifuge.subscribe(message.data.channel, function(ctx) {
                    //      // handle new message coming from channel "news"
                    //      console.log(ctx.data);
                    //  });
                 }

               });
          });
        this.centrifuge.connect();
    }
   },
     mounted(){
         this.welcome()
         this.callCentrifugo()
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
