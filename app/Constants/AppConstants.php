<?php

namespace App\Constants;

class AppConstants
{
    // PLUGIN
    const PLUGIN_ID = "616997699dd41e54786c9e04";

    // ZC Core Realated Constants
    const ZC_BASE_URL = 'https://api.zuri.chat/';
    const REQUEST_WRITE = 'data/write';
    const REQUEST_READ = 'data/read';

    // RTC Related Constants
    const CENTRIFUGO_URL = "https://realtime.zuri.chat/api";
    const CENTRIFUGO_API_KEY = 'apikey 58c2400b-831d-411d-8fe8-31b6e337738b';

    // RTC Publish Actons
    const ACTION_CREATE = "create";
    const ACTION_UPDATE = "update";
    const ACTION_DELETE = "delete";
    const ACTION_TOGGLE_ADMIN = "toggle_admin";
    const ACTION_REACT = "react";

    // RTC ROOMS
    const SIDEBAR_ROOM = "public_rooms";


    // Resource or collection Type
    const TYPE_TODO = "Todo";
    const TYPE_TASK = "Task";
    const TYPE_COMMENT = "Comment";
    const TYPE_COLLABORATOR = "Collaborator";
    const TYPE_REACTION = "Reaction";

    const TYPE_TODOS = "Todo Collection";
    const TYPE_TASKS = "Tasks Collection";
    const TYPE_COMMENTS = "Comment Collection";
    const TYPE_COLLABORATORS = "Collaborators Collection";
    const TYPE_REACTIONS = "Reaction Collection";

    // Status Code
    const STATUS_NOT_FOUND = 404;
    const STATUS_NO_AUTH = 401;
    const STATUS_OK = 200;
    const STATUS_ERROR = 500;
    const STATUS_FORBIDDEN = 403;

    // Status Message
    const MSG_404 = "Resource Not Found";
    const MSG_500 = "Server Error";
    const MSG_200 = "Success";
    const MSG_401 = "Lacking Authorization";
    const MSG_403 = "Forbidden";
    const MSG_204 = "Updated Successfully";
    const MSG_DELETED = "Deleted Successfully";
}
