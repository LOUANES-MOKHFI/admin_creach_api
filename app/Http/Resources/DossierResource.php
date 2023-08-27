<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DossierResource extends JsonResource
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
            'name'  => $this->name,
            'parent'  => $this->parent_id,
            'childs'  => $this->childs,
            'files'  => $this->files,
            
        ];
    }
}
