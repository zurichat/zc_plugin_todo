<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Requests\TodoRequest;
use App\Services\TodoService;
use Illuminate\Http\Request;


class TodoController extends Controller
{

    protected $todoService;
    protected $sam;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function createTodo(TodoRequest $request)
    {
        $channel = substr(uniqid(), 0, 10) . "-$request->title";
        $input =  $request->all();
        $labels =  $request->labels !== null ? $request->labels : [];
        $todoObject = array_merge($input, [
            'channel' => $channel,
            "tasks" => [],
            "labels" => $labels,
            "colaborators" => [],
            "created_at" => now()
        ]);

        $result = $this->todoService->create($todoObject);

        if (isset($result['object_id'])) {
            $responseWithId = array_merge(['_id' => $result['object_id']], $todoObject);

            $this->todoService->publish($channel, $responseWithId);
            $this->todoService->publish('common-room', ['user_id' => $request->user_id, 'channel' => $channel]);
            return response()->json(['status' => 'success', 'type' => 'Todo', 'data' => $responseWithId], 200);
        }

        return response()->json(['message' => $result['message']], 404);
    }

    // - This meythod and assoc endpoint are basically for testing purposes
    public function index()
    {
        $result = $this->todoService->all();
        $activeTodo = [];

        if (isset($result['status']) && $result['stutus'] == 404) {
            return response()->json($result, 404);
        }

        foreach ($result as $value) {
            if (!isset($value['archived_at']) || $value['archived_at'] === null) {
                array_push($activeTodo, $value);
            }
        }

        return response()->json(['status' => 'success', 'type' => 'Todo Collection', 'data' => $activeTodo],  200);
    }

    public function search_todo(Request $request)
    {
        $search = $this->todoService->search($request->query('key'), $request->query('q'));
        if (count($search) < 1 || isset($search['status'])) {
            return response()->json(['message' => 'No result found'], 404);
        }
        return response()->json($search, 200);
    }
}
