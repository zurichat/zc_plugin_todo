<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

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
        return response()->json($this->taskService->search($request->query('key'), $request->query('q')));
    }
    
    public function getLatestTask()
    {
        return response()->json($this->taskService->getLatestTask());
    }

    public function show($id)
    {
        $tasks = ($this->taskService->find($id))['data'];
        $data = [];
        foreach($tasks as $task){
            if($task['_id'] == $id){
                $data[] = $task;
            }
        }
        return response()->json([
                "status" => 200,
                "message" => "success",
                'data' => $data,
                    ]);
    }


    public function getTasksByCategory(Request $request)
    {
        // Validation of input
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'Error'=>'Request failed',
                'message' => $validator->errors()
            ], 400);
        }
        // Search for the category
        $allTasks = $this->taskService->all()['data'];
        $newArr = [];
        foreach ($allTasks as $value) {
            if (isset($value['category_id']) && $value['category_id'] == $request->category_id) {
                array_push($newArr, $value);
            }
        }
        return response()->json([
            'message' => 'Request success',
            'data' => $newArr
        ],200);
    }

    
        //Assigning Task to the user
        public function assignTeamToTask(Request $request, $task_id, $user_id){

            $this->validate($request, [
                
                'user_id' => 'required'
            ]);
           
            $task =   $this->taskService->find($task_id);
          
            array_push($task['collaborators'], $user_id);
            return $this->taskService->update($task, $task['_id']);
        }

}

