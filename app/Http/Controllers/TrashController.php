<?php

namespace App\Http\Controllers;

use App\Services\TodoService;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function trashTodo(Request $request, $todoId)
    {
        // Check if user has authorization to trash a todo

        $todo = $this->todoService->find($todoId);
        unset($todo['_id']);

        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }

        if (isset($todo['status'])) {
            $todo['deleted_at'] = now();
        }

        $updatedTodo = array_merge($todo, ['deleted_at' => now()]);
        $result = $this->todoService->update($updatedTodo, $todoId);

        if (isset($result['modified_documents']) && $result['modified_documents'] > 0) {
            // Publish To Centrifugo Here
            return response()->json(["status" => "success", "type" => "Todo", "data" => array_merge(['_id' => $todoId], $updatedTodo)], 200);
        }

        return response()->json(['status' => "error", 'message' => $result], 500);
    }

    public function unTrashTodo(Request $request, $todoId)
    {
        // Check if user has authorization to trash a todo
        $todo = $this->todoService->find($todoId);
        unset($todo['_id']);

        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }
        
        $results=array_search($todo['deleted_at'],$todo,true);
        if($results !== false) {
            $todo['deleted_at'] = null;
        }
        
        $updatedTodo = array_merge($todo, ['deleted_at' => null]);
        $result = $this->todoService->update($updatedTodo, $todoId);
        if (isset($result['modified_documents']) && $result['modified_documents'] > 0) {
            // Publish To Centrifugo Here
            return response()->json(["status" => "success", "type" => "Todo", "data" => array_merge(['_id' => $todoId], $updatedTodo)], 200);
        }
        return response()->json(['status' => "error", 'message' => $result], 500);
    }

    public function fetchTrashed(Request $request)
    {
        $all  = $this->todoService->all();

        $trashed = [];
        if (isset($all['status']) && $all['status'] == 404) {
            return response()->json(['status' => 'error', 'message' => $all], 404);
        }

        foreach ($all as $value) {
            if (isset($value['deleted_at']) && $value['deleted_at'] !== null) {
                array_push($trashed, $value);
            }
        }

        return response()->json(['status' => 'success', 'type' => 'Todo Collection', 'data' => $trashed], 200);
    }
}
