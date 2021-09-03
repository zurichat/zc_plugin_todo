<?php

namespace App\Http\Controllers;

use App\Services\TaskCommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CommentController extends Controller
{
    protected $taskCommentService;

    public function __construct(TaskCommentService $taskCommentService)
    {
        $this->taskCommentService = $taskCommentService;
    }

    public function index()
    {
    }

    public function store(Request $request)
    {

        $id = rand(1, 20);
        $userId = rand(1, 20);
        $data = [
            "content" => $request->content,
            "task_id" => $request->taskId,
            "user_id" => $userId,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ];

        // return response
        return response()->json($this->taskCommentService->create($data));
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function delete($id)
    {
    }
}