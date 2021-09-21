<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Services\TodoService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AssignUserController extends Controller
{
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function assign(Request $request, $todoId)
    {

        $todo = $this->todoService->find($todoId);

        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }

        $newColabo = ['user_id' => $request->user_id, 'admin_status' => $request->admin_status];
        array_push($todo['colaborators'], $newColabo);
        unset($todo['_id']);

        $result = $this->todoService->update($todo, $todoId);
        if (isset($result['modified_documents']) && $result['modified_documents'] > 0) {

            // Publish To Centrifugo
            $this->todoService->publish(
                'common-room',
                ['user_id' => $request->user_id, 'channel' => $todo['channel']]
            );

            $this->todoService->publish($todo['channel'], $todo['colaborators']);
            return response()->json(["status" => "success", "type" => "Todo", "data" => array_merge(['_id' => $todoId], $todo)], 200);
        }

        return response()->json(['status' => "error", 'message' => $result], 500);
    }
}
