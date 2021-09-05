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
        $task = $this->taskService->find($request->task_id);

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

        $response = $this->taskService->update($data, $request->task_id);

        return response()->json($response);
    }

        // Show Task Assigned to a Specific
        public function assignedTask(Request $request)
        {
        $allTasks = $this->taskService->all()['data'];
        $newArr = [];
        foreach ($allTasks as $value) {
            if (isset($value['user_id']) && $value['user_id'] == $request->user_id) {
                array_push($newArr, $value);
            }
        }
        return response()->json([
            'message' => 'Request success',
            'data' => $newArr
        ],200);
    }
}
