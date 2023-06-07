<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DemandeEmploiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => new UserResource($this->user_id),
            'offre_id' => new OffreEmploiResource($this->offre_id),
            'creche_id' => new CrecheResource($this->creche_id)
        ];
    }
}


