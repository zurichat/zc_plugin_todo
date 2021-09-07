<?php

namespace App\Http\Controllers;

use App\Services\TaskCommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TaskCommentController extends Controller
{
    protected $taskCommentService;

    public function __construct(TaskCommentService $taskCommentService)
    {
        $this->taskCommentService = $taskCommentService;
    }

    public function index()
    {
        return response()->json($this->taskCommentService->all());
    }

    public function getCommentsPerTask($taskId)
    {
        $comments = $this->taskCommentService->commentsPerTask('task_id', $taskId);
        return response()->json([
            'status' => 'success',
            'type' => 'comments',
            'count' => count($comments),
            'data' => $comments
        ], 200);
    }

    public function saveComment(Request $request)
    {
        $input = $request->validate([
            'user_id' => 'required',
            'task_id' => 'required',
            'body' => 'required'
        ]);

        $payload = array_merge($input, ['created_at' => Carbon::now()->toDateTime()]);
        return response()->json($this->taskCommentService->create($payload));
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
