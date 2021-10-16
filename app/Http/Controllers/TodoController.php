<?php

namespace App\Http\Controllers;

use App\Constants\AppConstants;
use Carbon\Carbon;
use App\Helpers\Response;
use App\Helpers\Manipulate;
use Illuminate\Http\Request;
use App\Services\TodoService;
use App\Services\TestTodoService;
use App\Http\Requests\TodoRequest;
use App\Http\Resources\SearchResource;
use App\Http\Resources\SidebarResource;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;


class TodoController extends Controller
{

    protected $todoService;


    public function __construct(TodoService $todoService, TestTodoService $testTodoService)
    {
        $this->todoService = $todoService;
        $this->testTodoService = $testTodoService;
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

        $org_id = Config::get('organisation_id');
        $user_id = Config::get('user_id');
        $workspaceChannelName = $org_id."_".$user_id."_sidebar";
        //$workspaceChannelName = "61695d8bb2cc8a9af4833d46_61695d8bb2cc8a9af4833d47_sidebar";

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

            $this->todoService->publishToCommonRoom($responseWithId, $channel, $input['user_id'], AppConstants::TYPE_TODO, null);
            $dataText = (new SideBarItemsController)->sidebarRTC();
            //update sidebar RTC
            $dataRtcPayload = [
                    "name" => "Todo Plugin",
                    "description" => "Todo Plugin sidebar",
                    "group_name" => "Active Todos",
                    "category" => "tools",
                    "show_group" => true,
                    "public_rooms" => $dataText["public_rooms"],
                    "joined_rooms" => $dataText["joined_rooms"],
            ];
            //publish to sidebar RTC
            $this->todoService->publishToRoomChannel($workspaceChannelName, $dataRtcPayload, " ", " ");
            return response()->json(['status' => AppConstants::MSG_200, 'type' => AppConstants::TYPE_TODO, 'data' => $responseWithId], 200);
        }

        return response()->json(['message' => $result['message']], AppConstants::STATUS_NOT_FOUND);
    }



    public function userTodos(Request $request)
    {
        $where = ['user_id' => $request['user_id']];
        $result = $this->todoService->findWhere($where);
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
        $search = $this->todoService->search($request->query('q'), $request->query('member_id'));
        //response pagination
        return response()->json(new SearchResource(TodoService::paginate($search, $request)), 200);
    }

    public function fetchSuggestions(Request $request)
    {
        $result = $this->todoService->findWhere(['user_id' => $request->query('member_id')]);
        $suggestions = [];
        if ((isset($result['status']))) {
            return response()->json(["message" => "error"], AppConstants::STATUS_NOT_FOUND);
        }

        foreach ($result as  $todo) {

            $suggestions[$todo['title']] =  $todo['title'];
            $suggestions[$todo['description']] =  $todo['description'];

            foreach ($todo['tasks'] as  $task) {
                $suggestions[$todo['_id']] =  $task['title'];
            }
        }


        return response()->json([
            'status' => AppConstants::MSG_200,
            'type' => 'suggections', 'data' => $suggestions
        ], AppConstants::STATUS_OK);
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
