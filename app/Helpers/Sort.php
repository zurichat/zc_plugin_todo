<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Services\TodoService;



class Sort
{
    protected $taskService;

    public function __construct(TaskService $taskService, TodoService $todoService)
    {
        $this->taskService = $taskService;
        $this->todoService = $todoService;
    }

    public static function sortAsc(Request $request){

        $sort = $request->order;
        if ($sort){
        $result = collect($result->sortBy('created_at'))->toArray();
        }
    }
    public static function sortAll(Request $request){

        if($request->order){
            if ($request->order === 'asc'){
                $all = collect($all->sortBy('archived_at'))->toArray();
            }
            else{
                $all = collect($all->sortByDesc('archived_at'))->toArray();
            }
        }
    }
}
