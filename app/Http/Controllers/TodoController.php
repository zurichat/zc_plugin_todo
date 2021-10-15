<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Helpers\Response;
use App\Helpers\Manipulate;
use Illuminate\Http\Request;
use App\Services\TodoService;
use App\Services\TestTodoService;
use App\Http\Requests\TodoRequest;
use App\Http\Resources\SearchResource;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Helpers\Sort;


class TodoController extends Controller
{

    protected $todoService;
    protected $sam;

    public function __construct(TodoService $todoService, TestTodoService $testTodoService)
    {
        $this->todoService = $todoService;
        $this->testTodoService = $testTodoService;
    }
    /**
     * for testing purpose only
     */
    public function index(Request $request)
    {
        Sort::sortAll($request);
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

        Sort::sortAsc($request);
        $activeTodo = [];

        if ((isset($result['status']) && $result['status'] == 404)) {
            return response()->json(["message" => "error"], 404);
        }

        if (count($result) < 1) {
            return response()->json(["status" => 404, 'message' => 'resource not found', 'data' => $activeTodo], 404);
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
        $search = $this->todoService->search($request->query('key'), $request->query('member_id'));
        if (count($search) < 1 || isset($search['status'])) {
            return response()->json(['message' => 'No result found'], 404);
        }
        //pagination
       return response()->json(new SearchResource(TodoService::paginate($search, $request)), 200);
    }

    public function getTodo($id, $user_id)
    {
        return  response()->json($this->todoService->findTodo($id, $user_id));
    }

    public function delete($todoId, $user_id)
    {
       return response()->json($this->todoService->delete($todoId, $user_id));
    }

    public function updateTodo(Request $request, $todoId, $user_id)
    {
       return response()->json($this->todoService->updateTodo($request->all(), $todoId, $user_id));
    }


    // test cache
    public function cacheIndex()
    {
        return $this->testTodoService->all();
    }

    public function cacheCreateTodo(TodoRequest $request)
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

        $result = $this->testTodoService->create($todoObject);

        if (isset($result['object_id'])) {
            $responseWithId = array_merge(['_id' => $result['object_id']], $todoObject);
            $this->testTodoService->publishToCommonRoom($responseWithId, $channel, $input['user_id'], 'todo', null);
            return response()->json(['status' => 'success', 'type' => 'Todo', 'data' => $responseWithId], 200);
        }

        return response()->json(['message' => $result['message']], 404);
    }

    public function cacheUserTodos(Request $request)
    {
        $where = ['user_id' => $request['user_id']];
        $result = $this->testTodoService->findWhere($where);
        $activeTodo = [];

        if ((isset($result['status']) && $result['status'] == 404)) {
            return response()->json(["message" => "error"], 404);
        }

        if (count($result) < 1) {
            return response()->json(["status" => 404, 'message' => 'resource not found', 'data' => $activeTodo], 404);
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


}
