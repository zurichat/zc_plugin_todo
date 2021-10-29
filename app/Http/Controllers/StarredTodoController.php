<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoService;
use App\Providers\SidebarEvent;


class StarredTodoController extends Controller
{
    //
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function star(Request $request, $todo_id)
    {
        return  response()->json($this->todoService->star($request->_id, $todo_id));
    }
}
