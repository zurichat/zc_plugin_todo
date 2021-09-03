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
		if (!empty($request->user_id) && !empty($request->task_id)){
			return response()->json($this->taskCommentService->create($request->all()));
		} else {
			// create random ids for comment
			$userId = rand(1, 20);
			$taskId = 1;

			// sketch the response data
			$data = [
				"content" => $request->content,
				"task_id" => $taskId,
				"user_id" => $userId,
				"created_at" => Carbon::now(),
			];

			// return response
			return response()->json($this->taskCommentService->create($data));
		}
    }

    public function show($id)
    {
        return response()->json($this->taskCommentService->find($id));
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->taskCommentService->update($request->all(), $id));
    }

    public function delete($id)
    {
    }
}
