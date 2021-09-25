<?php

namespace App\Http\Controllers;

use App\Http\Resources\SidebarResource;
use App\Services\TodoService;
use App\Services\UserService;
use Illuminate\Support\Facades\Config;

class SideBarItemsController extends Controller
{
    public function sidebar()
    {
        // get all todo
        $todos = (new TodoService)->all();
        // convert to a collection
        $todos = collect($todos);
        // get all public todo
        $publicTodos = $todos->filter(function ($item) {
            return  $item['type'] == 'public' && !TodoService::isTodoArchived($item) && !TodoService::isTodoDeleted($item) && (new UserService)->belongToUser($item);
        });
        // get all private todo
        // private todo belongs to organisation
        $privateTodos = $todos->filter(function ($item) {
            return  $item['type'] == 'private' && !TodoService::isTodoArchived($item) && !TodoService::isTodoDeleted($item) && (new UserService)->belongToUser($item);
        });
        return response()->json(new SidebarResource(['public_rooms' => collect($publicTodos), 'joined_rooms' => collect($privateTodos)]));
    }
}
