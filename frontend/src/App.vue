<template>
    <div>
        <router-view />
    </div>
</template>

<script>
// import {getLoggedInUser} from "./plugins/auth"
// import {getAllTodos} from './plugins/xhr'
// import { GetUserInfo } from "zuricontrol";
import Centrifuge from "centrifuge";
import { mapActions } from "vuex";
import { mapGetters } from "vuex";
// let { GetUserInfo } = import ( "zuricontrol");
export default {
    name: "App",
    data() {
        return {
            user: null,
            centrifuge: new Centrifuge(
                "wss://realtime.zuri.chat/connection/websocket",
                { debug: true }
            )
        };
    },
    components: {},
    computed: {
        ...mapGetters({
            isUser: "todos/user"
        })
    },
    methods: {
        ...mapActions({
            HandleAllTodos: "todos/HandleGetTodos",
            add_user: "todos/ADD_USER",
            addTodo: "todos/centrifugeAddTodo"
        }),

        welcome() {
            const _this = this;
            if (
                location.hostname === "localhost" ||
                location.hostname === "127.0.0.1"
            ) {
                // On localhost return this
                console.log("local", location.hostname);

                _this.user = {
                    0: {
                        _id: "614f089fe35bb73a77bc2b77",
                        bio: "",
                        deleted: false,
                        deleted_at: "0001-01-01T00:53:28+00:53",
                        display_name: "",
                        email: "calebbala15@gmail.com",
                        files: null,
                        first_name: "",
                        image_url: "",
                        joined_at: "2021-09-25T13:31:43.105+02:00",
                        last_name: "",
                        org_id: "614679ee1a5607b13c00bcb7",
                        phone: "",
                        presence: "true",
                        pronouns: "",
                        role: "member",
                        settings: {
                            chat_settings: {
                                enter_is_send: false,
                                font_size: "",
                                media_visibility: false,
                                theme: "",
                                wallpaper: ""
                            },
                            messages_and_media: {
                                additional_options: null,
                                bring_emails_into_zuri: "",
                                convert_emoticons_to_emoji: false,
                                custom: false,
                                emoji: "",
                                emoji_as_text: false,
                                frequently_used_emoji: false,
                                inline_media_and_links: null,
                                messages_one_click_reaction: null,
                                names: "",
                                show_jumbomoji: false,
                                theme: ""
                            },
                            notifications: {
                                channel_hurdle_notification: false,
                                email_notifications_for_mentions_and_dm: null,
                                message_preview_in_each_notification: false,
                                mute_all_sounds: false,
                                my_keywords: "",
                                notification_schedule: "",
                                notify_me_about: "",
                                thread_replies_notification: false,
                                use_different_settings_mobile: "",
                                when_iam_not_active_on_desktop: ""
                            },
                            sidebar: {
                                always_show_in_the_sidebar: null,
                                list_private_channels_seperately: false,
                                organize_external_conversations: false,
                                show_conversations: "",
                                show_profile_picture_next_to_dm: false,
                                sidebar_sort: ""
                            },
                            themes: {
                                colors: "",
                                themes: ""
                            }
                        },
                        socials: null,
                        status: "",
                        time_zone: "",
                        user_name: "calebbala15"
                    }
                };
                this.add_user(_this.user);
                this.HandleAllTodos();
            } else {
                // GetUserInfo().then(user => {
                //     console.log("me", user);
                //     _this.user = user;
                //     this.add_user(_this.user);
                //     this.HandleAllTodos();
                //     console.log("user", user);
                // });
                // console.log('live')
                // this.user = JSON.parse(sessionStorage.getItem("user"));
                // this.add_user(this.user);
                // if (!this.user) {
                //   // Not Logged In, so return anonymous user info
                //  this.user = { created_at: "2021-09-22T15:01:05.927620504Z",
                //           display_name: "",
                //           email: "calebbala15@gmail.com",
                //           first_name: "Caleb",
                //           id: "614b453144a9bd81cedc0b25",
                //           last_name: "Bala Gammagaci ",
                //           phone: "",
                //           status: 0,
                //           time_zone: "",
                //           token: "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJjb29raWUiOiJNVFl6TWpjME1UZ3pNbnhIZDNkQlIwUlplRTVVUm1oUFYwMDBUbnBWTWs5RWJHeFBSMUp0VFZSb2JVNHlSVFZPUVQwOWZJcFFPaDFIMlVaaGVKNlNmeWEyYjE3TnFTUE9ycWJYSk9Dc2tmaGRBSUQzIiwiZW1haWwiOiJjYWxlYmJhbGExNUBnbWFpbC5jb20iLCJpZCI6IjYxNTFhOWM4NzU2ODllOGRmMThmN2E5NCIsIm9wdGlvbnMiOnsiUGF0aCI6Ii8iLCJEb21haW4iOiIiLCJNYXhBZ2UiOjc5Mzk5MzcxOTYsIlNlY3VyZSI6ZmFsc2UsIkh0dHBPbmx5IjpmYWxzZSwiU2FtZVNpdGUiOjB9LCJzZXNzaW9uX25hbWUiOiJmNjgyMmFmOTRlMjliYTExMmJlMzEwZDNhZjQ1ZDVjNyJ9.uemzEdAX3e5wKSvc2oyAKd4MuxK9DVAdTFdQvWNmwEQ",
                //           updated_at: "0001-01-01T00:00:00Z"
                //           }
            }
        },

        callCentrifugo() {
            console.log("i say i wan sleep");
            const _this = this;
            // this.centrifuge = new Centrifuge(
            //     "wss://realtime.zuri.chat/connection/websocket",
            //     { debug: true }
            // );
            // this.centrifuge.setToken('token');
            console.log("_this.isUser");
            this.centrifuge.on("connect", ctx => {
                console.log("connected", ctx);
                this.centrifuge.subscribe("6154eb8bc134-hello", function(
                    message
                ) {
                    console.log("testing subscription", message);
                    // check if auth user id is same a subscriber id
                    if (message.data.subscriberId === _this.isUser["0"]._id) {
                        //  console.log(2);
                        _this.addTodo(message.data.details);
                        console.log("hello its centrifugo");
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
    mounted() {
        // this.auth();
        this.welcome();
        this.callCentrifugo();
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
