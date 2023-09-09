<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DemandeEmploiUserResource extends JsonResource
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
            'user_id'  => new UserResource($this->user),
            'emploi' => new EmploiResource($this->emploi),
            'other_emploi' => $this->other_emploi,
            'wilaya' => new WilayasResource($this->wilaya),
            'commune'=> new CommuneResource($this->commune),
            'degre_etude' => $this->degre_etude,
            'experience'  => $this->experience,
            'phone'       => $this->phone,
        ];
    }
}
