<?php

namespace App\Http\Controllers;


use App\Http\Requests\TodoRequest;
use App\Services\TodoService;
use Illuminate\Http\Request;


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
        $todoObject = array_merge($input, [
            'channel' => "$randomString-$request->title",
            "tasks" => [],
            "labels" => [],
            "colaborators" => [],
            "created_at" => now()
        ]);

        $result = $this->todoService->create($todoObject);

        if ($result['status'] == 200 && isset($result["data"])) {
            $responseWithId = array_merge(['_id' => $result["data"]['object_id']], $todoObject);
            return response()->json(['status' => 'success', 'type' => 'Todo', 'data' => $responseWithId], 200);
        }

        return response()->json(['message' => $result['message']], 400);
    }


    public function index()
    {
        $result = $this->todoService->all();
        return $result;
        if ($result['status'] == 200 && isset($result["data"])) {
            return response()->json(['status' => 'success', 'type' => 'Todo Collection', 'data' => $result], 200);
        }

        return response()->json(['message' => $result['message']], 400);
    }
}
