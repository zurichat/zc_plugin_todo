<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Helpers\Sort;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\Collaborator;
use App\Services\TaskService;
use App\Services\TodoService;
use App\Services\UserService;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TodoResource;
use App\Http\Requests\AddTaskRequest;
use App\Http\Requests\MarkTaskRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TodoResourceCollection;

class TaskController extends Controller
{

    protected $taskService;
    protected $todoService;
    protected $userService;
    protected $collaboratorInstance;

    public function __construct(TaskService $taskService, TodoService $todoService, UserService $userService)
    {
        $this->taskService = $taskService;
        $this->todoService = $todoService;
        $this->userService = $userService;
        $this->collaboratorInstance = new Collaborator($this->userService);
    }


    /**
     * Show the search results.
     *
     * @return mixed
     */

    public function index(Request $request)
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
        Sort::sortAll($request);

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

    public function taskcollection(Request $request)
    {

        $allTasks = $this->taskService->all();
        Sort::sortAll($request);

        $sort = $request->order;
        if ($sort){
        $allTasks = collect($allTasks->sortBy('created_at'))->toArray;
        }

        $time = time();
        $arr = array();
        foreach ($allTasks as $value) {
            if (array_key_exists('end_date', [$value])) {
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


    public function addTask(AddTaskRequest $request, $todoId)
    {
        $todo = $this->todoService->find($todoId);

        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }


        $newTasks = [
            "task_id" => Str::uuid(), "title" => $request->title,
            "recurring" => $request->recurring, "status" => 0
        ];

        array_push($todo['tasks'], $newTasks);
        unset($todo['_id']);

        $result = $this->todoService->update($todo, $todoId);

        if (isset($result['modified_documents']) && $result['modified_documents'] > 0) {

            // Publish To Centrifugo
            $todoWithId = array_merge(['_id' => $todoId], $todo);
            $this->todoService->publishToRoomChannel($todo['channel'], $todoWithId, "Task", "create");
            // Send Mail
            $user_ids = $this->collaboratorInstance->listAllUsersInTodo($todo);
            $this->collaboratorInstance->sendMails($user_ids, 'Task Added', 'A task with the title'.$request->title.'has been added to the todo');

            return response()->json(["status" => "success", "type" => "Todo", "data" => $todoWithId], 200);
        }

        return response()->json(['status' => "error", 'message' => $result], 500);
    }

    public function markTask(Request $request, $todoId)
    {
        $adminExist = false;
        // inialize value for task
        $todo = $this->todoService->findBy('_id', $todoId);
        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }
        if ($todo['user_id'] != $request->user_id) {
            foreach ($todo['collaborators'] as $key => $value) {
                if ($value['user_id'] == $request->user_id && $value['admin_status'] == 1) {
                    $adminExist = true;
                }
            }
        } else {
            $adminExist = true;
        }
        for ($i = 0; $i < count($todo['tasks']); $i++) {
            if ($todo['tasks'][$i]['task_id'] == $request->task_id) {
                $todo['tasks'][$i]['status'] = $request->status;
            }
        }

        unset($todo['_id']);

        $result = $this->todoService->update($todo, $todoId);
        if (isset($result['modified_documents']) && $result['modified_documents'] > 0) {
            $todoWithId = array_merge(['_id' => $todoId], $todo);
            $this->todoService->publishToRoomChannel($todo['channel'], $todoWithId, 'todo', 'update');

            // Send Mail
            $user_ids = $this->collaboratorInstance->listAllUsersInTodo($todo);
            $this->collaboratorInstance->sendMails($user_ids, 'Task Added', 'A task with the title' . $request->title . 'has been marked in the todo');
            return response()->json(["status" => "success", "data" => $todoWithId], 200);
        } else {
            return response()->json(["status" => "error", "data" => $result], 500);
        }
    }
}
