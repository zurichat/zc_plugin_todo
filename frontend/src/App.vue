<template>
    <div>
        <router-view />
    </div>
</template>

<script>
import { getLoggedInUser } from "./plugins/auth";
// import {getAllTodos} from './plugins/xhr'
// import { GetUserInfo } from 'zuricontrol'
// import Centrifuge from 'centrifuge'
import { mapActions } from "vuex";
import { mapGetters } from "vuex";
import CentrifugeSetup from "./plugins/realtime";
// let { GetUserInfo } = import ( "zuricontrol");
export default {
<<<<<<< HEAD
    name: "App",
    data() {
        return {
            user: null
        };
    },
    components: {},
    computed: {
        ...mapGetters({
            isUser: "todos/user",
            centrifuge: "todos/centrifuge"
        })
    },
    methods: {
        ...mapActions({
            HandleAllTodos: "todos/HandleGetTodos",
            add_user: "todos/ADD_USER",
            cn_centri: "todos/CONNECT_CENTRIFUGE",
            addTodo: "todos/centrifugeAddTodo"
        }),
        welcome() {
            getLoggedInUser();
        },

        listenToCommonRoom(message) {
            const _this = this;
=======
  name: 'App',
  data(){
    return  {
      user: null,
        
        }
  },
  components: { },
  computed:  {
    ...mapGetters({
      isUser: "todos/user",
      centrifuge: 'todos/centrifuge'
    })
  },
   methods: {
      ...mapActions({
        HandleAllTodos: "todos/HandleGetTodos",
        add_user : 'todos/ADD_USER',
        cn_centri : 'todos/CONNECT_CENTRIFUGE',
        addTodo : 'todos/centrifugeAddTodo',
        getMembers: 'todos/getAllMembers'
      }),
        welcome(){
           getLoggedInUser()
           
          }, 
          listenToCommonRoom(message){
            const _this = this
>>>>>>> acbbaa5f0775683537d7b055ede1c704380d009a
            // check if auth user id is same a subscriber id
            if (message.data.subscriberId === _this.isUser["0"]._id) {
                // //  console.log(2);
                //     _this.addTodo(message.data.details)
                //     console.log('hello its centrifugo');
                if (message.data.collection === "todo") {
                    console.log("hello its rifugo");
                    console.log(message.data);
                    _this.addTodo(message.data.details);
                    console.log(message);
                    //  _this.centrifuge.subscribe(message.data.channel, function(ctx) {
                    //      //  handle new message coming from channel "news"
                    //      console.log(ctx)
                    //  });
                }
            }
        },
        enterCommonRoom() {
            CentrifugeSetup("common-room", this.listenToCommonRoom);
        }
        //     callCentrifugo(){
        //                console.log('i say i wan sleep');
        //                const _this = this
        //          _this.cn_centri()
        //          // this.centrifuge.setToken('token');
        //          console.log('_this.isUser');
        //          _this.centrifuge.on("connect", (ctx) => {
        //             console.log("connected", ctx);
        //              _this.centrifuge.subscribe("common-room", function(message) {
        //            // check if auth user id is same a subscriber id
        //              if (message.data.subscriberId === _this.isUser["0"]._id) {
        //                 // //  console.log(2);
        //                 //     _this.addTodo(message.data.details)
        //                 //     console.log('hello its centrifugo');
        //                 if(message.data.collection === 'todo'){
        //                        console.log('hello its rifugo');
        //                       console.log(message.data);
        //                        _this.addTodo(message.data.details)
        //                      console.log(message);}

<<<<<<< HEAD
        //                   //  _this.centrifuge.subscribe(message.data.channel, function(ctx) {
        //                   //      //  handle new message coming from channel "news"
        //                   //      console.log(ctx)
        //                   //  });
        //              }
=======
    //            });
    //       });
    //     _this.centrifuge.connect();
    // }
   },
     mounted(){
         this.welcome()
         this.enterCommonRoom()
         this.getMembers()
        //  console.log(this.getAllMembers())
        //  console.log(this.welcome)
        // console.log(this.isUser[0].org_id)
       }
   }
>>>>>>> acbbaa5f0775683537d7b055ede1c704380d009a

        //            });
        //       });
        //     _this.centrifuge.connect();
        // }
    },
    mounted() {
        this.welcome();
        this.enterCommonRoom();
    }
};
</script>

<style lang="scss">
@import "./assets/styles/app.css";
@import url("https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap");
body {
    font-family: "Lato", sans-serif;
    -webkit-font-smoothing: antialiased;
}
</style>
