<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OffreEmploiResource extends JsonResource
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
            'creche_id'  => $this->creche_id,
            'emploi_id'  => $this->emploi_id,
            'wilaya_id'  => $this->wilaya_id,
            'commune_id'  => $this->commune_id,
            'degre_etude' => $this->degre_etude,
            'experience'  => $this->experience,
            'phone'       => $this->phone,
        ];
    }
}
