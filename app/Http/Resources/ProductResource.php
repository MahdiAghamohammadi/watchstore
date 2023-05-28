<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'name_en' => $this->name_en,
            'slug' => $this->slug,
            'price' => $this->price,
            'review' => $this->review,
            'count' => $this->count,
            'sold' => $this->sold,
            'image' => url("images/admin/products/big/{$this->image}"),
            'guaranty' => $this->guaranty,
            'discount' => $this->discount,
            'description' => $this->description,
            'is_special' => $this->is_special,
            'special_expire' => $this->special_expire,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'category' => $this->category->title,
            'brand_id' => $this->brand_id,
            'brand' => $this->brand->name
        ];
    }
}
