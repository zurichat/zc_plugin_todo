<?php

namespace App\Http\Controllers;

use App\Helpers\Collaborator;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\TaskRequest;
use App\Services\TaskCommentService;
use App\Services\TodoService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class TaskCommentController extends Controller
{
    protected $todoService;
    protected $taskCommentService;

    public function __construct(TodoService $todoService, TaskCommentService $taskCommentService)
    {
        $this->todoService = $todoService;
        $this->taskCommentService = $taskCommentService;
    }


    public function getCommentsPerTask($taskId)
    {
        $result = $this->taskCommentService->commentsPerTask('task_id', $taskId);
        if ($result['status'] == 200 && isset($result["data"])) {
            return response()->json([
                'status' => 'success',
                'type' => 'comments',
                'count' => count($result),
                'data' => $result
            ], 200);
        }

        return response()->json(['message' => $result['message']], 400);
    }



    public function saveComment(CommentRequest $request, $todoId)
    {

        $todo = $this->todoService->find($todoId);

        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }

        $input = $request->only('user_id', 'task_id', 'body');
        $payload = array_merge($input, ['todo_id' => $todo['_id'], 'created_at' => Carbon::now()]);

        if (!Collaborator::haveAccess($todo, $request->user_id)) {
            return response()->json(['message' => 'User Lack Access'], 401);
        }

        $result = $this->taskCommentService->create($payload);

        if (isset($result['object_id'])) {
            $responseWithId = array_merge(['_id' => $result['object_id']], $payload);
            $this->taskCommentService->publishToRoomChannel($todo['channel'], $responseWithId, 'comment', 'create');
            return response()->json(['status' => 'success', 'type' => 'Comment', 'data' => $responseWithId], 200);
        }

        return response()->json(['message' => $result['message']], 404);
    }


    public function update(Request $request, $taskId, $channel)
    {
        $comment = $this->taskCommentService->find($taskId);
        if (isset($comment['status']) && $comment['status'] == 404) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        if (!Collaborator::isCreator($comment, $request->user_id)) {
            return response()->json(['message' => 'Lack Authorization'], 401);
        }

        $comment['body'] = $request->body;
        unset($comment['_id']);
        $result = $this->taskCommentService->update($comment, $taskId);

        if (isset($result['modified_documents']) && $result['modified_documents'] > 0) {
            $commentWithId = array_merge(['_id' => $taskId], $comment);

            $this->taskCommentService->publishToRoomChannel($channel, $commentWithId, 'comment', 'update');

            return response()->json(['status' => 'success', 'message' => 'Comment Updated successfully'], 200);
        }

        return response()->json(['status' => 'error', 'message' => $result], 500);
    }

    public function getCommentPerTodo($todoId)
    {
        $result = $this->taskCommentService->commentsPerTask('todo_id', $todoId);
        if ($result['status'] == 200 && isset($result["data"])) {
            return response()->json([
                'status' => 'success',
                'type' => 'comments',
                'count' => count($result),
                'data' => $result
            ], 200);
        }

        return response()->json(['message' => $result['message']], 400);
    }
}
