<?php

namespace App\Http\Controllers;

use App\Services\TaskService;

class TaskSearchController extends Controller
{

    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * get all tasks.
     *
     * @return mixed
     */

     public function index()
    {
        $tasks = $this->taskService->all();
        return response()->json(['tasks'=>$tasks], 200);
    }

}
