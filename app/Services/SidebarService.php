<?php

namespace App\Services;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\SideBarItemsController;

class SidebarService
{    
    /**
     * sideBarItemsController
     *
     * @var SideBarItemsController
     */
    protected $sideBarItemsController;
    protected $todoService;   
    /**
     * __construct
     *
     * @param  SideBarItemsController $sideBarItemsController
     * @return void
     */
    function __construct(SideBarItemsController $sideBarItemsController, todoService $todoService)
    {
        $this->SideBarItemsController = $sideBarItemsController;
        $this->todoService = $todoService;
    }
        
    /**
     *
     * @return void
     */
    public function sidebarAttr()
    {
        $channelName = $this->sidebarCentrifugoName();
        $payload = $this->sidebarDataAttr();
        if(isset($channelName) && isset($payload)){
            //dd($channelName);
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
        $dataText = (new SideBarItemsController)->sidebarRTC();
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
