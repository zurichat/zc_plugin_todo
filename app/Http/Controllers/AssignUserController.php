<?php

namespace App\Http\Controllers;

use App\Services\TodoService;
use Illuminate\Http\Request;

class AssignUserController extends Controller
{
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function assign(Request $request, $todoId)
    {
        $todo = $this->todoService->find($todoId);
        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }

        $test = "eric";



        // [
        //     "user_id" => $request->user_id,
        //     "channel_id" => "blank-for-now",
        //     "admin" => $request->admin_status
        // ];



        // $data = array();
        // $data['status_id'] = $task['status_id'];
        // $data['parent_id'] = $task['parent_id'];
        // $data['start_date'] = $task['start_date'];
        // $data['created_at'] = $task['created_at'];
        // $data['archived_at'] = $task['archived_at'];
        // $data['recurring'] = $task['recurring'];
        // $data['reminder'] = $task['reminder'];
        // $data['assigned_users'] = [];

        // $data['assigned_users'] = array_push($data['assigned_users'], $request->user_id);

        // $response = $this->taskService->update($data, $request->task_id);

        // return response()->json($response);
    }
}
