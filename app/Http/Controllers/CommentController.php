<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index()
    {
        return response()->json($this->commentService->all());
    }

    public function store(Request $request)
    {
        // create a random id for comment
        $id = rand(1, 20);
        $userId = rand(1, 20);
        $taskId = 1;
        // sketch the response data
        $data = [
            "id" => $id,
            "content" => $request->content,
            "task_id" => $taskId,
            "user_id" => $userId,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ];
        
        return response()->json($this->commentService->create($data));
    }

    public function show($id)
    {
        return response()->json($this->commentService->find($id));
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->commentService->update($request->all(), $id));
    }

    public function delete($id)
    {
        return response()->json($this->commentService->delete($id));
    }
}
