<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskDemoController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        return response()->json($this->taskService->all());
    }

    public function store(Request $request)
    {
        return response()->json($this->taskService->create($request->all()));
    }

    public function show($id)
    {
        return response()->json($this->taskService->find($id));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
          'title'=>"required",
          'content'=>"required",
          'start_date'=>'required',
          'end_date'=>'required',
        ]);
        return response()->json($this->taskService->update($request->all(), $id));
    }

    public function delete($id)
    {
        return response()->json($this->taskService->delete($id));
    }
}
