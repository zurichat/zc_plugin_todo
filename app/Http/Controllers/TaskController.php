<?php

namespace App\Http\Controllers;

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

     public function index()
    {
        $tasks = $this->taskService->all();
        return response()->json(['tasks'=>$tasks], 200);
    }

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
    public function modifyShow($id)
    {
        return view('updateDueDate');
    }
    public function updateTaskDate(Request $request, $id)
    {
        return response()->json($this->taskService->update($request->all(), $id));
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

    public function categoryTestView($id)
    {
        return view('updateCategory');
    }



    public function updateTaskCategory(Request $request, $id)
    {
        return response()->json($this->taskService->update($request->all(), $id));
    }

    public function editTask(Request $request, $id)
    {
        return response()->json($this->taskService->update($request->all(), $id));
    }

    public function taskcollection(){

        $allTasks = $this->taskService->all()['data'];
        $time = time();
        $arr = array();
        foreach ($allTasks as $value){
            if (array_key_exists('end_date', $value)){
                $end_date = $value['end_date'];
                $convert_date = strtotime($end_date);
                if($convert_date >= $time){

                       $arr = $value;

                }
            }
        }
        return response()->json($arr);

    }

    public function sort(Request $request)
    {
        $parameter = $request->sort;
        $tasks = $this->taskService->all();
        $collectionTasks = collect($tasks['data'])->sortBy($parameter);
        return $collectionTasks;
    }

}
