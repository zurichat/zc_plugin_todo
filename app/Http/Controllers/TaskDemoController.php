<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Http\Resources\TodoResource;

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
        return response()->json($this->taskService->update($request->all(), $id));
    }

    public function delete($id)
    {
        return response()->json($this->taskService->delete($id));
    }

    public function search(Request $request)
    {
        // return response()->json($this->taskService->search($request->query('q')));
    }
    public function resource(Request $request)
    {
        $task = $this->taskService->resource();
        return $task;
    }
}
