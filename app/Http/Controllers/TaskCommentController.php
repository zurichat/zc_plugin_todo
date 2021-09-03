<?php

namespace App\Http\Controllers;

use App\Services\TaskCommentService;
use Illuminate\Http\Request;

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
        return response()->json($this->taskCommentService->create($request->all()));
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
