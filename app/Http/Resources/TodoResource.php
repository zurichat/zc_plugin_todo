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
        
        return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status_id' => $this->status_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'parent_id' => $this->parent_id,
            'workspace_id' => $this->workspace_id,
            'category_id' => $this->category_id,
            'priority_id' => $this->priority_id,
            'recurring' => $this->recurring,
            'color_code' => $this->color_code,
            // 'reminder' =>$this->reminder,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at
        ];
        // return parent::toArray($request);
    }
}
