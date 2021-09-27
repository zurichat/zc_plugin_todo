<template>
  <div>
    <router-view />
  </div>
</template>

<script>
import { GetUserInfo } from "zuricontrol"
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
        getAllTodos: "todos/getAllTodos",
        add_user : 'todos/ADD_USER',
        addTodo : 'todos/centrifugeAddTodo'
      }),
       async auth(){
         GetUserInfo();
         if (location.hostname === "localhost" || location.hostname === "127.0.0.1") {

    // On localhost return this
    console.log('local')
        
        this.user = {
          Organizations: [
              "614679ee1a5607b13c00bcb7"
          ],
          _id: "614b453144a9bd81cedc0b25",
          created_at: "2021-09-22T17:01:05.927620504+02:00",
          deactivated: false,
          deactivated_at: "0001-01-01T00:00:00Z",
          email: "calebbala15@gmail.com",
          email_verification: null,
          first_name: "Caleb",
          isverified: true,
          last_name: "Bala Gammagaci ",
          password: "$2a$14$pEGWT3jbv0w.oq/t9tEnYeXIucnTTfNwnPgmdfj/TxNB0AbYkE51K",
          password_resets: null,
          phone: "",
          settings: null,
          time_zone: "",
          updated_at: "0001-01-01T00:00:00Z",
          workspaces: null
      }
        this.add_user(this.user);
        } else {
          console.log('live')
          this.user = JSON.parse(sessionStorage.getItem("user"));
          this.add_user(this.user);
          if (!this.user) {
            // Not Logged In, so return anonymous user info
           this.user = {
          Organizations: [
              "614679ee1a5607b13c00bcb7"
          ],
          _id: "614b453144a9bd81cedc0b25",
          created_at: "2021-09-22T17:01:05.927620504+02:00",
          deactivated: false,
          deactivated_at: "0001-01-01T00:00:00Z",
          email: "calebbala15@gmail.com",
          email_verification: null,
          first_name: "Caleb",
          isverified: true,
          last_name: "Bala Gammagaci ",
          password: "$2a$14$pEGWT3jbv0w.oq/t9tEnYeXIucnTTfNwnPgmdfj/TxNB0AbYkE51K",
          password_resets: null,
          phone: "",
          settings: null,
          time_zone: "",
          updated_at: "0001-01-01T00:00:00Z",
          workspaces: null
      }
            this.add_user(this.user);
          }

         }
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
                 if (message.data.subscriberId === _this.isUser._id) {
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
         this.auth()
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
