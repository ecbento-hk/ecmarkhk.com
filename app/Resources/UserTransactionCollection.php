<?php

namespace App\Http\Api\V1\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserTransactionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}