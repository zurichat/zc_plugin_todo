<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Config;

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
            'room_name' => $this['title'],
            'room_url' => '/todo#/details/' . $this['_id'],
            'room_image' => 'https://www.svgrepo.com/show/347559/todo.svg'
        ];
    }
}
