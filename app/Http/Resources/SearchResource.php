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
            'title' => $this['query'],
            'description' => '',
            'pagination' => [
                'total_results' => $this['total_count'],
                'current_page' => $this['current_page'],
                'per_size' => $this['per_page'],
                'page_count' => $this['page_count'],
                'first_page' => $this['first_page'],
                'last_page' => $this['last_page'],
                'next' => $this['next_page'],
                'previous' => $this['previous_page']
            ],
            'search_parameters' => [
                'query' => $this['query'] ,
                'filters' => [],
                'plugin' => 'Todo'
            ],

            'results' => [
                'entity' => 'others',
                'data' => SearchDataResource::collection($this['data'])
            ]
        ];
    }
}
