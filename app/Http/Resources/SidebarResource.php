<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'plugin_id' => session('plugin_id'),
            'organisation_id' => session('organisation_id'),
            'user_id' => '232',
            'group_name' => 'Todo',
            'show_group' => false,
            'joined_rooms' => SidebarRoomsResource::collection($this['joined_rooms']),
            'public_rooms' => SidebarRoomsResource::collection($this['public_rooms'])
        ];
    }
}
