<?php

namespace App\Constants;

class AppConstants
{
    // RTC Publish Actons
    const ACTION_CREATE = "create";
    const ACTION_UPDATE = "update";
    const ACTION_DELETE = "delete";
    const ACTION_TOGGLE_ADMIN = "toggle_admin";
    const ACTION_REACT = "react";

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
