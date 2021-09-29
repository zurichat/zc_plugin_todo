<?php

namespace App\Http\Controllers;

use App\Helpers\Collaborator;
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

    public function saveComment(TaskRequest $request, $todoId)
    {

        $todo = $this->todoService->find($todoId);

        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }

        $input = $request->only('user_id', 'task_id', 'body');
        $payload = array_merge($input, ['created_at' => Carbon::now()]);

        if (!Collaborator::haveAccess($todo, $request->user_id)) {
            return response()->json(['message' => 'User Lack Access'], 401);
        }

        $result = $this->taskCommentService->create($payload);
        if (isset($result['object_id'])) {
            $responseWithId = array_merge(['_id' => $result['object_id']], $payload);
            $this->taskCommentService->publishToRoomChannel($todo['channel'], $responseWithId, 'comment');
            return response()->json(['status' => 'success', 'type' => 'Comment', 'data' => $responseWithId], 200);
        }

        return response()->json(['message' => $result['message']], 404);
    }


    public function update(Request $request, $id)
    {
        $comment = $this->taskCommentService->find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
        return response()->json($this->taskCommentService->update($request->all(), $comment['_id']));
    }


    public function delete($id)
    {
        return response()->json($this->taskCommentService->delete($id));
    }
}
