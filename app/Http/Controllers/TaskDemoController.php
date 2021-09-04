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
        return response()->json($this->taskService->update($request->all(), $id));
    }

    public function delete($id)
    {
        return response()->json($this->taskService->delete($id));
    }

    public function sort(Request $request)
    {
        $parameter = $request->sort;
        $tasks = $this->taskService->all();
        $collectionTasks = collect($tasks['data'])->sortBy($parameter);
        return $collectionTasks;
    }

    public function search(Request $request)
    {
        // return response()->json($this->taskService->search($request->query('q')));
    }
}
