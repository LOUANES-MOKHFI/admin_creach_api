<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid'  => $this->uuid,
            'title'  => $this->title,
            'slug'  => $this->slug,
            'question'  => $this->question,
            'response'  => $this->response,
            'category_id' => $this->category_id,
        ];
    }
}
