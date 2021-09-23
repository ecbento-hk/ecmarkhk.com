<?php

namespace App\Http\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "menu_product_id"=> $this->menu_product_id,
            "store_id"=> $this->store_id,
            "product_id"=> $this->product_sku_id,
            'image' => $this->product->image,
            'title' => $this->product->title,
            "quantity"=> $this->quantity,
            "price"=> $this->price,
            "amount"=> $this->amount,
            "menu_date"=> date('Y-m-d', strtotime($this->menu_date)),
        ];
    }
}
