<?php

namespace App\Http\Resources;

use App\Http\Resources\SearchDataResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
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
            'status' => 'ok',
            'query' => $this['query'],
            'plugin' => 'Todo',
            'pagination' => [
                'total_count' => $this['total_count'],
                'current_page' => $this['current_page'],
                'per_page' => $this['per_page'],
                'page_count' => $this['page_count'],
                'first_page' => $this['first_page'],
                'last_page' => $this['last_page'],
                'next_page' => $this['next_page'],
                'previous_page' => $this['previous_page']
            ],

            'data' => SearchDataResource::collection($this['data']),
            'filter_suggestions' => [
                'in' => [],
                'from' => []
            ]
        ];
    }
}
