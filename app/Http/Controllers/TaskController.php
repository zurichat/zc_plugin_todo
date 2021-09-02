<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller{

    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Show the search results.
     *
     * @return mixed
     */
    public function search(Request $request)
    {
        return response()->json($this->taskService->search($request->query('q')));
    }


}
