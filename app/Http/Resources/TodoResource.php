<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    protected $taskService;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return [
        //     '_id' => $this->_id,
        //     'user_id' => $this->user_id,
        //     'title' => $this->title,
        //     'description' => $this->description,
        //     'start_date' => $this->start_date,
        //     'end_date' => $this->end_date,
        //     'status' => [],
        //     'collaborators' => [],
        //     'labels' => [],
        //     'category_id' => $this->category_id,
        //     'priority_id' => $this->priority_id,
        //     'reminder' =>$this->reminder,
        //     // 'created_at' => $this->created_at,
        //     // 'updated_at' => $this->updated_at
        // ];
        return parent::toArray($request);
    }
}
