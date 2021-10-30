<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\TodoService;
use App\Services\TestTodoService;
use App\Http\Requests\TodoRequest;
use App\Http\Resources\SearchResource;
use App\Helpers\Sort;
use App\Providers\SidebarEvent;

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
    public function index(Request $request)
    {
        Sort::sortAll($request);
        return $this->todoService->all();
    }

    /**
     *  createTodo is a callable to create a todo
     */
    public function createTodo(TodoRequest $request)
    {
        return $this->todoService->createTodo($request);
    }


    /**
     *  userTodo is a callable function for fetching user active todos
     */
    public function userTodos(Request $request)
    {
        return $this->todoService->fetchUserTodo($request);
    }

    /**
     *  search_todo is a callable function for seraching user todos
     */
    public function search_todo(Request $request)
    {
        $search = $this->todoService->search($request->query('q'), $request->query('member_id'));
        //response pagination
        return response()->json(new SearchResource(TodoService::paginate($search, $request)), 200);
    }

    /**
     *  fetchSuggestions is a callable function for fetching possible works/phrase for  user search
     */

    public function fetchSuggestions(Request $request)
    {
        return $this->todoService->fetchSuggestions($request);
    }

    /**
     *  getTodo returns detailes of a particular user todo
     */
    public function getTodo($id, $user_id)
    {
        return  response()->json($this->todoService->findTodo($id, $user_id));
    }

    public function delete($todoId, $user_id)
    {
        return response()->json($this->todoService->delete($todoId, $user_id));
    }

    /**
     *  updateTodo: Callable function to update a TODO
     */
    public function updateTodo(Request $request, $todoId, $user_id)
    {
        return response()->json($this->todoService->updateTodo($request->all(), $todoId, $user_id));
    }

    public function star(Request $request, $todo_id)
    {
        return  response()->json($this->todoService->star($request->_id, $todo_id));
    }
}
