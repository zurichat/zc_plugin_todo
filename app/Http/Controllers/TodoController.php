<?php

namespace App\Http\Controllers;

use App\Helpers\Manipulate;
use App\Helpers\Response;
use App\Http\Requests\TodoRequest;
use App\Services\TodoService;
use Carbon\Carbon;
use Illuminate\Http\Request;


class TodoController extends Controller
{

    protected $todoService;
    protected $sam;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }
    /**
     * for testing purpose only
     */
    public function index()
    {
        return $this->todoService->all();
    }

    public function createTodo(TodoRequest $request)
    {

        $channel = Manipulate::buildChannel($request->title);
        $input =  $request->all();
        $labels =  $request->labels !== null ? $request->labels : [];
        $todoObject = array_merge($input, [
            'channel' => $channel,
            "tasks" => [],
            "labels" => $labels,
            "collaborators" => [],
            "created_at" => now()
        ]);

        $result = $this->todoService->create($todoObject);

        if (isset($result['object_id'])) {
            $responseWithId = array_merge(['_id' => $result['object_id']], $todoObject);
            $this->todoService->publishToCommonRoom($responseWithId, $channel, $input['user_id'], 'todo', null);
            return response()->json(['status' => 'success', 'type' => 'Todo', 'data' => $responseWithId], 200);
        }

        return response()->json(['message' => $result['message']], 404);
    }


    public function userTodos(Request $request)
    {
        $where = ['user_id' => $request['user_id']];
        $result = $this->todoService->findWhere($where);
        $activeTodo = [];

        if (isset($result['status']) && $result['status'] == 404) {
            return response()->json($result, 404);
        }

        for ($i = 0; $i < count($result); $i++) {
            if (!isset($result[$i]['deleted_at']) && (!isset($result[$i]['archived_at']) || $result[$i]['archived_at'] == null)) {
                array_push($activeTodo, $result[$i]);
            }
        }

        return response()->json([
            'status' => 'success',
            'type' => 'Todo Collection',
            'count' => count($activeTodo), 'data' => $activeTodo
        ], 200);
    }

    public function search_todo(Request $request)
    {
        $search = $this->todoService->search($request->query('key'), $request->query('q'), $request->query('user_id'));
        if (count($search) < 1 || isset($search['status'])) {
            return response()->json(['message' => 'No result found'], 404);
        }
        return response()->json($search, 200);
    }

    public function getTodo($id, $user_id)
    {
        return  response()->json($this->todoService->findTodo($id, $user_id));
    }

    public function delete($todoId)
    {
        $todo = $this->todoService->findWhere(['_id' => $todoId]);
        $deleted_at = ['deleted_at' => Carbon::now()];
        $update = $this->todoService->update($deleted_at, $todoId);

        return response()->json(['message' => 'Todo deleted', 'todo' => $update]);
    }
}
