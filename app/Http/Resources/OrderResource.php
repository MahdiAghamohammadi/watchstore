<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'total_price' => $this->total_price,
            'code' => $this->code,
            'status' => $this->status,
            'order_details' => OrderDetailResource::collection($this->orderDetails),
            'transaction_id' => $this->transaction_id,
        ];
    }
}
