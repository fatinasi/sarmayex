<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'data' => $this->map(function($item) {
                return [
                    'title' => $item->title,
                    'description' => $item->description,
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
          'status' => 'success'
        ];
    }
}
