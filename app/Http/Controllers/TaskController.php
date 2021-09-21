<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Services\TodoService;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TodoResource;
use App\Http\Requests\AddTaskRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TodoResourceCollection;


class TaskController extends Controller
{

    protected $taskService;
    protected $todoService;

    public function __construct(TaskService $taskService, TodoService $todoService)
    {
        $this->taskService = $taskService;
        $this->todoService = $todoService;

    }


    /**
     * Show the search results.
     *
     * @return mixed
     */

    public function index()
    {
        $task = $this->taskService->all();
        if (isset($task['status']) && $task['status'] == '404') {
           return response()->json(['message' => 'Tasks not found'], 404);
        }
        return response()->json(new TodoResourceCollection($task), 200);
    }

    public function getLatestTask()
    {
        return response()->json($this->taskService->getLatestTask());
    }

    public function show($id)
    {
        $tasks = $this->taskService->findBy('_id', $id);
        if (empty($tasks)) {
           return response()->json(['message' => 'Todo not found'], 404);
        }
        return response()->json($tasks, 200);
    }

    public function updateTaskDate(Request $request, $id)
    {
        return response()->json($this->taskService->update($request->all(), $id));
    }

    public function toggleArchiveStatus($id)
    {
        $task = $this->taskService->find($id); // Get the Task

        $archived = array_key_exists('archived_at', $task) && $task['archived_at']  ?  '' : Carbon::now(); // Set new date if it is null or empty, else set back to empty

        // prepare the payload
        $data = array();
        $data['archived_at'] = $archived;

        //response from zccore
        return response()->json($this->taskService->update($data, $id));
    }



    public function getTasksByCategory(Request $request)
    {
        // Validation of input
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'Error' => 'Request failed',
                'message' => $validator->errors()
            ], 400);
        }
        // Search for the category
        $allTasks = $this->taskService->all();
        $newArr = [];
        foreach ($allTasks as $value) {
            if (isset($value['category_id']) && $value['category_id'] == $request->category_id) {
                array_push($newArr, $value);
            }
        }
        return response()->json([
            'message' => 'Request success',
            'data' => $newArr
        ], 200);
    }


    public function updateTaskCategory(Request $request, $id)
    {
        return response()->json($this->taskService->update($request->all(), $id));
    }

    public function editTask(Request $request, $id)
    {
        return response()->json($this->taskService->update($request->all(), $id));
    }

    public function taskcollection()
    {

        $allTasks = $this->taskService->all();
        $time = time();
        $arr = array();
        foreach ($allTasks as $value) {
            if (array_key_exists('end_date', $value)) {
                $end_date = $value['end_date'];
                $convert_date = strtotime($end_date);
                if ($convert_date >= $time) {

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
        $collectionTasks = collect($tasks)->sortBy($parameter);
        return $collectionTasks;
    }



    public function store(TaskRequest $request)
    {
        $data = $request->except('org', 'token');
        $tasks = $request->input('tasks');
        $i = 1;
        $data['tasks'] = [];
        foreach ($tasks as $task) {
            $data['tasks'][] = ['serial_no' => $i, 'title' => $task,  'status' => 'undone'];
            $i++;
        }
        $data['status'] = $request->input('status');
        $data['type'] = $request->input('type', 'public');
        $data['admins'][] = $data['user_id'] = $request->input('user'); // user id
        $data['parent_id'] = $request->input('parent_id');
        $data['start_date'] = $request->input('start_date', date('Y-m-d'));
        $data['created_at'] = date('Y-m-d');
        $data['updated_at'] = null;
        $data['archived_at'] = null;
        $data['recurring'] = $request->input('recurring', false);
        $data['reminder'] = $request->input('reminder');
        $response = $this->taskService->create($data);
        if (isset($response['status']) && $response['status'] == "404") {
            return response()->json([
                'status' =>  false,
                'type' => 'error',
                'message' => 'Todo not created',
            ], 500);
        }
        return response()->json([
            'status' =>  true,
            'type' =>  'success',
            'message' => 'Todo created successfully',
            'data' => $data
        ], 201);
    }

    public function archived(Request $request)
    {
        $tasks = $this->taskService->all();

        $newArr = [];
        foreach ($tasks as $value) {
            if (isset($value['archived_at']) && $value['archived_at'] != null) {
                array_push($newArr, $value);
            }
        }
        return response()->json([
            'message' => 'Request success',
            'data' => $newArr
        ], 200);
    }


    public function addTask(AddTaskRequest $request, $id) {
       $todo = $this->todoService->findBy('_id', $id);
        // return $this->todoService->all();
        $data = array();
        $tasks = $request->input('tasks');

            foreach ($tasks as $task) {
                $data['tasks'][] = ['task_id' => uniqid(), 'title' => $task, 'status' => 0, 'created_at' => Carbon::now()->toDateTimeString() ];
            }

        $response = $this->todoService->update($data, $id);

        if (isset($response['status']) && $response['status'] == "404")
        {
            return response()->json([
                'status' => false,
                'type' => error,
                'message' => 'Task could not be added'
            ], 500);
        }
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => 'Task has been added successfully',
            'data' => $data
        ], 201);
    }

}

