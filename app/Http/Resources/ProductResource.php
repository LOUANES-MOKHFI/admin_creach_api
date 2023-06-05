<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ImagesProductResource;
use App\Http\Resources\VendorResource;

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
            'slug' => $this->slug,
            'price' => $this->price,
            'gros_price' => $this->gros_price,
            'description' => $this->description,
            'categories' => CategoryResource::collection($this->categories),
            'images' => ImagesProductResource::collection($this->images),
            'vendor' => new VendorResource($this->vendor)
        ];
    }
}


