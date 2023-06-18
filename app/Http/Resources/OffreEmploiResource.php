<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\CommuneResource;
use  App\Http\Resources\WilayasResource;
use  App\Http\Resources\EmploiResource;
use  App\Http\Resources\CrecheResource;
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
            'creche_id'  => new CrecheResource($this->creche),
            'emploi' => new EmploiResource($this->emploi),
            'wilaya' => new WilayasResource($this->wilaya),
            'commune'=> new CommuneResource($this->commune),
            'degre_etude' => $this->degre_etude,
            'experience'  => $this->experience,
            'phone'       => $this->phone,
        ];
    }
}
