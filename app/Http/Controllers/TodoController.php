<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Requests\TodoRequest;
use App\Services\TodoService;
use Illuminate\Http\Request;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Resources\TodoResource;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{

    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function createTodo(TodoRequest $request)
    {
        $randomString = substr(uniqid(), 0, 10);
        $input =  $request->all();
        $labels =  $request->labels !== null ? $request->labels : [];
        $todoObject = array_merge($input, [
            'channel' => "$randomString-$request->title",
            "tasks" => [],
            "labels" => $labels,
            "colaborators" => [],
            "created_at" => now()
        ]);

        $result = $this->todoService->create($todoObject);

        if (isset($result['object_id'])) {
            $responseWithId = array_merge(['_id' => $result['object_id']], $todoObject);
            return response()->json(['status' => 'success', 'type' => 'Todo', 'data' => $responseWithId], 200);
        }

        return response()->json(['message' => $result['message']], 404);
    }

    // - This method and assoc endpoint are basically for testing purposes
    public function index()
    {
        $result = $this->todoService->all();
        if (isset($result['status']) && $result['stutus'] == 404) {
            return response()->json($result, 404);
        }
        return response()->json(['status' => 'success', 'type' => 'Todo Collection', 'data' => $result],  200);
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'color_code' => 'required|max:255',
            'end_date' => 'required|max:255',
            'workspace_id' => 'required|max:255',
            'category_id' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' =>  false,
                'type' => 'error',
                'message' => 'missing required fields',
                'data' => $validator->errors()->messages()
            ], 422);
        }
        $data = $request->except('_method', '_token');
        $data['status_id'] = $request->input('status_id', 1);
        $data['parent_id'] = $request->input('parent_id');
        $data['start_date'] = $request->input('start_date', date('Y-m-d'));
        $data['created_at'] = date('Y-m-d');
        $data['updated_at'] = null;
        $data['archived_at'] = null;
        $data['recurring'] = $request->input('recurring', false);
        $data['reminder'] = $request->input('reminder');
        $response = $this->taskService->create($data);
        if(!$response){
            return response()->json([
                'status' =>  false,
                'type' => 'error',
                'message' => 'Todo not created'
            ], 500);
        }
        return response()->json([
            'status' =>  true,
            'type' =>  'success',
            'message' => 'Todo created successfully'
        ], 200);
    }

    //TODO: Test frontend link to be removed or modified;
    public function showPage()
    {
        return view('test');
    }

    public function search_todo(Request $request)
    {
        $search = $this->todoService->search($request->query('key'), $request->query('q'));
        if (count($search) < 1 || isset($search['status'])) {
           return response()->json(['message' => 'No result found'], 404);
        }
        return response()->json($search, 200);
    }

    public function delete_todo($id) 
    {
        $this->todoService->delete($id);
        return response()->json(['status' => 'success', 'message' => 'Successfully deleted todo'], 200);
    }

    //Function to test the resource
     public function showResource() : TodoResource
    {
        $data =  [
            'id' => '0',
            'title' => 'Demo Todo',
            'description' => 'This is a demo todo to test the resource',
            'status_id' => '1',
            'start_date' => '2021-09-03',
            'end_date' => '2021-09-05',
            'parent_id' => '012',
            'workspace_id' => '013',
            'category_id' => '01',
            'priority_id' => '03',
            'recurring' => [
                'status' => true
            ],
            'color_code' => '#001',
            'created_at' => '2021-09-03',
            'updated_at' => 'null'
        ];
        return new TodoResource($data);
    }
}
