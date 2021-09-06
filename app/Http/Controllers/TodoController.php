<?php

namespace App\Http\Controllers;

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


    //TODO: Test frontend link to be removed or modified;
    public function showPage()
    {
        return view('test');
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
