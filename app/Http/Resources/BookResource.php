<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\NiveauBookResource;
class BookResource extends JsonResource
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
            'name'  => $this->name,
            'slug'  => $this->slug,
            'pdf_file'  => $this->pdf_file,
            'image'  => $this->image,
            'niveau_id'  => new NiveauBookResource($this->niveau),
        ];
    }
}

