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
            'name' => 'Todo Plugin',
            'description' => 'Shows todo items',
            'plugin_id' => Config::get('plugin_id'),
            'organisation_id' => Config::get('organisation_id'),
            'user_id' => Config::get('user_id'),
            'group_name' => 'Todo',
            'sidebar_logo' => 'https://media.publit.io/file/calendar-page-with-circular-clock-symbol-svgrepo-com.svg',
            'joined_rooms' => SidebarRoomsResource::collection($this['joined_rooms']),
            'public_rooms' => SidebarRoomsResource::collection($this['public_rooms'])
        ];
    }
}
