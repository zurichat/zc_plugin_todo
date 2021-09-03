<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;

class AssignTaskUserController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function assign(Request $request)
    {
        $all_tasks = $this->taskService->all();

        $all_tasks["data"][7]["users"] = $request->user;

        return response()->json($all_tasks["data"][7]);
    }
}
