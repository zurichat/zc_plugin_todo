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

    public function assign(Request $request, $id)
    {
        $task = $this->taskService->find($id);

        $data = array();
        $data['status_id'] = $task['status_id'];
        $data['parent_id'] = $task['parent_id'];
        $data['start_date'] = $task['start_date'];
        $data['created_at'] = $task['created_at'];
        $data['archived_at'] = $task['archived_at'];
        $data['recurring'] = $task['recurring'];
        $data['reminder'] = $task['reminder'];
        $data['assigned_users'] = [];

        $data['assigned_users'] = array_push($data['assigned_users'], $request->user_id);

        $response = $this->taskService->update($data, $id);

        return response()->json($response);
    }
}
