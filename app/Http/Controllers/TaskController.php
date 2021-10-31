<?php

namespace App\Http\Controllers;

use App\Helpers\Sort;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\Collaborator;
use App\Services\TaskService;
use App\Services\TodoService;
use App\Services\UserService;
use App\Http\Requests\AddTaskRequest;
use App\Http\Requests\TaskCategoryRequest;
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
     *  @param  Request $request
     *  @return mixed
     */

    public function index(Request $request)
    {
        return response()->json(new TodoResourceCollection($this->taskService->all()), 200);
    }
    /**
     * @return mixed
     * This method orders the tasks in order of newly created
     */
    public function getLatestTask()
    {
        return response()->json($this->taskService->getLatestTask());
    }

    /**
     * @param string
     * @return mixed
     * returns a task by the TodoID
     */
    public function show($id)
    {
        return response()->json($this->taskService->findBy('_id', $id), 200);
    }

    public function updateTaskDate(Request $request, $id)
    {
        return response()->json($this->taskService->update($request->all(), $id));
    }

    public function toggleArchiveStatus($id)
    {
        return $this->taskService->toggleStatus($id);
    }

    public function getTasksByCategory(TaskCategoryRequest $request)
    {

        return response()->json(
                [
                    'message' => 'Request success',
                    'data' => $this->taskService->taskCategory($request)
                ],
            200
            );
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

        return response()->json($this->taskService->taskCollection($request));
    }

    public function sort(Request $request)
    {
        return response()->json($this->taskService->sort($request));
    }


    public function addTask(AddTaskRequest $request, $todoId)
    {
       return response()->json(["status" => "success", "type" => "Todo", "data" => $this->taskService->add($request, $todoId)], 200);
    }

    public function markTask(Request $request, $todoId)
    {
        return response()->json(["status" => "success", "data" => $this->taskService->MarkTask($request, $todoId)], 200);
    }
}
