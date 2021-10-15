<?php

namespace App\Http\Controllers;

use App\Helpers\Sort;
use Illuminate\Http\Request;
use App\Services\TodoService;

class ArchiveController extends Controller
{
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function archiveTodo(Request $request, $todoId)
    {
        // Check if user has authorization to archive

        $todo = $this->todoService->find($todoId);
        unset($todo['_id']);

        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }

        if (isset($todo['status'])) {
            $todo['archived_at'] = now();
        }

        $updatedTodo = array_merge($todo, ['archived_at' => now()]);
        $result = $this->todoService->update($updatedTodo, $todoId);

        if (isset($result['modified_documents']) && $result['modified_documents'] > 0) {
            // Publish To Centrifugo Here
            $this->todoService->publishToRoomChannel($todo['channel'], $todo, "todo", "archive");

            return response()->json(["status" => "success", "type" => "Todo", "data" => array_merge(['_id' => $todoId], $updatedTodo)], 200);
        }

        return response()->json(['status' => "error", 'message' => $result], 500);
    }

    public function unArchiveTodo(Request $request, $todoId)
    {
        // Check if user has authorization to archive
        $todo = $this->todoService->find($todoId);
        unset($todo['_id']);

        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }

        $results=array_search($todo['archived_at'],$todo,true);
        if($results !== false) {
            $todo['archived_at'] = null;
        }

        $updatedTodo = array_merge($todo, ['archived_at' => null]);
        $result = $this->todoService->update($updatedTodo, $todoId);
        if (isset($result['modified_documents']) && $result['modified_documents'] > 0) {
            // Publish To Centrifugo Here
            return response()->json(["status" => "success", "type" => "Todo", "data" => array_merge(['_id' => $todoId], $updatedTodo)], 200);
        }
        return response()->json(['status' => "error", 'message' => $result], 500);
    }

    public function fetchArchived(Request $request)
    {
        // This function should normally be user centric
        // but for the ime being, leave for now
        Sort::sortAsc($request);

        $all  = $this->todoService->all();
        $archived = [];
        if (isset($all['status']) && $all['status'] == 404) {
            return response()->json(['status' => 'error', 'message' => $all], 404);
        }

        foreach ($all as $value) {
            if (isset($value['archived_at']) && $value['archived_at'] !== null) {
                array_push($archived, $value);
            }
        }

        return response()->json(['status' => 'success', 'type' => 'Todo Collection', 'data' => $archived], 200);
    }
}
