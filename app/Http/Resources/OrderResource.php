<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductOrderResource;

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
            'id'  => $this->id,
            'user_id'  => $this->user_id,
            'product_id'  => new ProductOrderResource($this->product),
            'vendor_id'  => $this->vendor_id,
            'qty'  => $this->qty,
            'name'  => $this->name,
            'phone'  => $this->phone,
            'email'  => $this->email,
            'address'  => $this->address,
            'total_order'  => $this->total_order,
            'note'  => $this->note,
        ];
    }
}









