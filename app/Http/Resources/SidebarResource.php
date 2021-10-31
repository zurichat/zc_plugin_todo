<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Config;

class SidebarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            
            'category' => "tools",
            'description' => "Todo Plugin Sidebar",
            'group_name' => 'Active Todos',
            'joined_rooms' => SidebarRoomsResource::collection($this['joined_rooms']),
            'name' => "Todo Plugin",
            'organisation_id' => Config::get('organisation_id'),
            'plugin_id' => "6138deac99bd9e223a37d8f5",
            'public_rooms' => SidebarRoomsResource::collection($this['public_rooms']),
            "show_group" => false,
            'user_id' => Config::get('user_id')
        ];
    }
}
