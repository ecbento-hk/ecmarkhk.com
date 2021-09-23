<?php

namespace App\Http\Api\V1\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return[
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'desc' => $this->desc,
            'image' => $this->image,
            'count' => $this->count,
            'priority' => $this->priority,
        ];
    }
}
