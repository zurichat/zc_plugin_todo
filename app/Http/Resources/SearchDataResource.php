<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchDataResource extends JsonResource
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
            '_id' => $this['_id'],
            'title' => $this['title'],
            'email' => '',
            'content' => $this['description'],
            'image_url' => [],
            'created_by' => [],
            'created_at' => $this['created_at'],
            'destination_url' => '/detail/'.$this['_id']
        ];
    }
}
