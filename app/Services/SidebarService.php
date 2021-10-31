<?php

namespace App\Services;
use Illuminate\Support\Facades\Config;
use App\Http\Resources\SidebarResource;
use App\Services\TodoService;

class SidebarService
{
    /**
     * todoService
     *
     * @var todoService
     */
    protected $todoService;
    protected $sidebarServices;
    /**
     * __construct
     *
     * @param  SideBarItemsController $sideBarItemsController
     * @return void
     */
    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function sidebar($dataType)
    {
        $org_id = Config::get('organisation_id');
        $user_id = Config::get('user_id');
        $workspaceChannelName = $org_id."_".$user_id."_sidebar";
        // get all todo by user
        $todos = (new TodoService)->findWhere(['user_id' => $user_id]);
        // check if response has error
        if (is_array($todos) && isset($todos['status'])) {
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
         // peal time to centrifugo
         $dataRtcPayload = [
            "name" => "Todo Plugin",
            "description" => "Todo Plugin sidebar",
            "group_name" => "Active Todos",
            "category" => "tools",
            "show_group" => false,
            "public_rooms" => collect($publicTodos),
            "joined_rooms" => collect($privateTodos)
        ];
        //publish to centrifugo and return
        (new TodoService)->publishToRoomChannel($workspaceChannelName, $dataRtcPayload, " ", " ");
        $response = (new SidebarResource(['public_rooms' => collect($publicTodos), 'joined_rooms' => collect($privateTodos)]));
        return $this->jsonEncoded($response, $dataType);
    }

    public static function jsonEncoded($data, $dataType){
        $response = isset($data) && $dataType != null ? $data->toJson(): $data;
        return $response;
    }

    /**
     *
     * @return boolean
     */
    public function sidebarAttr()
    {
        $channelName = $this->sidebarCentrifugoName();
        $payload = $this->sidebarDataAttr();
        if(isset($channelName) && isset($payload)){
            //publish to sidebar RTC
            $this->todoService->publishToRoomChannel($channelName, $payload, " ", " ");
            return true;
        }
        return false;
    }

    public function sidebarCentrifugoName()
    {
            $org_id = Config::get('organisation_id');
            $user_id = Config::get('user_id');
            $workspaceChannelName = $org_id."_".$user_id."_sidebar";
            return $workspaceChannelName;
    }

    public function sidebarDataAttr()
    {
        $dataText = $this->sidebar('json');
        $data = [
            "name" => "Todo Plugin",
            "description" => "Todo Plugin sidebar",
            "group_name" => "Active Todos",
            "category" => "tools",
            "show_group" => false,
            "public_rooms" => $dataText["public_rooms"],
            "joined_rooms" => $dataText["joined_rooms"],
        ];
        return $data;
    }
}
