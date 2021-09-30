import { GetUserInfo } from 'zuricontrol'
export const getLoggedInUser = () => {

    // if (location.hostname === "localhost" || location.hostname === "127.0.0.1") {
    //     // On localhost return this
    //     console.log('local')
    //     return {
    //         0: {
    //             _id: "614f089fe35bb73a77bc2b77",
    //             bio: "",
    //             deleted: false,
    //             deleted_at: "0001-01-01T00:53:28+00:53",
    //             display_name: "",
    //             email: "calebbala15@gmail.com",
    //             files: null,
    //             first_name: "",
    //             image_url: "",
    //             joined_at: "2021-09-25T13:31:43.105+02:00",
    //             last_name: "",
    //             org_id: "614679ee1a5607b13c00bcb7",
    //             phone: "",
    //             presence: "true",
    //             pronouns: "",
    //             role: "member",
    //             settings: {
    //                 chat_settings: {
    //                     enter_is_send: false,
    //                     font_size: "",
    //                     media_visibility: false,
    //                     theme: "",
    //                     wallpaper: ""
    //                 },
    //                 messages_and_media: {
    //                     additional_options: null,
    //                     bring_emails_into_zuri: "",
    //                     convert_emoticons_to_emoji: false,
    //                     custom: false,
    //                     emoji: "",
    //                     emoji_as_text: false,
    //                     frequently_used_emoji: false,
    //                     inline_media_and_links: null,
    //                     messages_one_click_reaction: null,
    //                     names: "",
    //                     show_jumbomoji: false,
    //                     theme: ""
    //                 },
    //                 notifications: {
    //                     channel_hurdle_notification: false,
    //                     email_notifications_for_mentions_and_dm: null,
    //                     message_preview_in_each_notification: false,
    //                     mute_all_sounds: false,
    //                     my_keywords: "",
    //                     notification_schedule: "",
    //                     notify_me_about: "",
    //                     thread_replies_notification: false,
    //                     use_different_settings_mobile: "",
    //                     when_iam_not_active_on_desktop: ""
    //                 },
    //                 sidebar: {
    //                     always_show_in_the_sidebar: null,
    //                     list_private_channels_seperately: false,
    //                     organize_external_conversations: false,
    //                     show_conversations: "",
    //                     show_profile_picture_next_to_dm: false,
    //                     sidebar_sort: ""
    //                 },
    //                 themes: {
    //                     colors: "",
    //                     themes: ""
    //                 }
    //             },
    //             socials: null,
    //             status: "",
    //             time_zone: "",
    //             user_name: "calebbala15"
    //         },
    //         currentWorkspace: "614679ee1a5607b13c00bcb7",
    //         token: "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJjb29raWUiOiJNVFl6TWprek9UZzRNWHhIZDNkQlIwUlplRTVVVW1oYWFsazFUakpaZDA5RVl6Qk9lbWN4V1hwVmVGa3lUbWxhVVQwOWZIN1pubnNzZkxaN1Z3NGhMRjJtOWVibkprbGNhak5qVDM2S1drRWlTUUk0IiwiZW1haWwiOiJjYWxlYmJhbGExNUBnbWFpbC5jb20iLCJpZCI6IjYxNTRhZjY5N2YwODc0Nzg1YzUxY2NiZSIsIm9wdGlvbnMiOnsiUGF0aCI6Ii8iLCJEb21haW4iOiIiLCJNYXhBZ2UiOjc5NDAxMjYxODAsIlNlY3VyZSI6ZmFsc2UsIkh0dHBPbmx5IjpmYWxzZSwiU2FtZVNpdGUiOjB9LCJzZXNzaW9uX25hbWUiOiJmNjgyMmFmOTRlMjliYTExMmJlMzEwZDNhZjQ1ZDVjNyJ9.GimEjtK0R7lNG08QOhlYczxic5wVY01h9XOWLUkLAsc"
    //     }
    //} else {
    return GetUserInfo()

    //}
}