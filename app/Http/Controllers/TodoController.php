<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
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


    public function index()
    {
        $result = $this->todoService->all();
        if (isset($result['status'])) {
            return response()->json($result, 404);
        }
        return response()->json(['status' => 'success', 'type' => 'Todo Collection', 'data' => $result],  200);
    }
}
