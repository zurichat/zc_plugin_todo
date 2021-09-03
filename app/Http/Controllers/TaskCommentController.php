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
    }

    public function store(Request $request)
    {
        // create a random id for comment
        $id = rand(1, 20);
        $userId = rand(1, 20);
        $taskId = 1;
        // sketch the response data
        $data = [
            "content" => $request->content,
            "task_id" => $taskId,
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
