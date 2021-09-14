<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SidebarRoomsResource extends JsonResource
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
            'title' => $this['title'],
            'id' => $this['_id'],
            'unread' => null,
            'members' => null,
            'icon' => 'shovel',
            'action' => 'open',
            "organisation_id" => $this['organisation_id'],
            "owner" => $this['owner'],
            "user_id" => $this['user_id']
        ];
    }
}
