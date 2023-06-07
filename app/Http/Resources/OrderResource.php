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
            'user_id'  => $this->user_id,
            'product_id'  => $this->product_id,
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









