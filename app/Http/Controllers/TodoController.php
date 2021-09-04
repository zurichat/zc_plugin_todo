<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Resources\TodoResource;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{

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

        $search = $this->taskService->search($request->query('key'), $request->query('q'));
        if (empty($search)) {
           return response()->json(['message' => 'No result found'], 404);
        }

        return response()->json($search, 200);
    }


}
