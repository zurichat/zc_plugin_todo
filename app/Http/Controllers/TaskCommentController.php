<?php

namespace App\Http\Controllers;

use App\Services\TaskCommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class TaskCommentController extends Controller
{
    protected $taskCommentService;

    public function __construct(TaskCommentService $taskCommentService)
    {
        $this->taskCommentService = $taskCommentService;
    }

    public function index()
    {

        $result = $this->taskCommentService->all();
        return $result;
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

    /**
        * @author {Alpha2Chris14}
    */
    public function findTaskCommentById($id){
        return response()->json($this->taskCommentService->findTaskCommentById($id));
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
