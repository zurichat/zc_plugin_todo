<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller{

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

    public function show($id)
    {
        $tasks = ($this->taskService->find($id))['data'];

        foreach($tasks as $d){
            if($d['_id'] == $id){
                $data[] = $d;
            }
        }
        return response()->json([
                "status" => 200,
                "message" => "success",
                'data' => $data,
                    ]);
    }


}
