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
        $org_id = Config::get('organisation_id');
        $user_id = Config::get('user_id');
        $workspaceChannelName = $org_id."_".$user_id."_sidebar";
        // get all todo
        $todos = (new TodoService)->all();
        // check if response has error
        if(is_array($todos) && isset($todos['status'])){
            return response()->json($todos);
        }
        // convert to a collection
        $todos = collect($todos);
        // get all public todo
        // public todo belongs to users
        $publicTodos = $todos->filter(function ($item) {
            return  $item['type'] == 'public' && !TodoService::isTodoArchived($item) && !TodoService::isTodoDeleted($item) && (new UserService)->belongToUser($item);
        });
        // get all private todo
        // private todo belongs to organisation
        // check if user_id is found in users
        $privateTodos = $todos->filter(function ($item) {
            return  $item['type'] == 'private' && !TodoService::isTodoArchived($item) && !TodoService::isTodoDeleted($item) && (new UserService)->isACollaborator($item);
        });
        // prepend dashboard to private todo
        $privateTodos->prepend(['room_name' => 'Todo Dashboard','room_url' => '/todo','room_image' => 'https://www.svgrepo.com/show/346459/todo-fill.svg']);
        // return response
        // $data =  [new SidebarResource(['public_rooms' => collect($publicTodos), 'joined_rooms' => collect($privateTodos)])];
        // $todo = (new TodoService)->publishToRoomChannel($workspaceChannelName, $data, 'Todo', "update sidebar");
        return response()->json(new SidebarResource(['public_rooms' => collect($publicTodos), 'joined_rooms' => collect($privateTodos)]));

    }
}
