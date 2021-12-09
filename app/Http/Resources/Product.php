<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'reorder_level' => $this->reorder_level,
            'price' => $this->price,
            'year' => $this->year,
            'model' => $this->model,
            'image_url' => $this->image_url,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
