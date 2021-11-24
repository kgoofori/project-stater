<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'description' => $this->description,
            'excerpt' => $this->excerpt,
            'price' => $this->selling_price,
            'sku' => $this->sku,
            'thumbnail' => $this->image,
            'totalDiscount' => $this->totalDiscount,
            'images' => $this->images->pluck('path'),
            'category' => $this->category,
            'status' => $this->status,
        ];
    }
}
