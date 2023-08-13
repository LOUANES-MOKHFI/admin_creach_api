<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProgrammeCrecheResource;
use App\Http\Resources\BlogResource;
use  App\Http\Resources\CommuneResource;
use  App\Http\Resources\PaysResource;
use  App\Http\Resources\WilayasResource;
class CrecheResource extends JsonResource
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
            'type'  => $this->type,
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'type_creche' => $this->type_creche,
            'creche_name' => $this->creche_name,
            'programme' => $this->programme_id,
            'other_programme' => $this->other_programme,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'tiktok' => $this->tiktok,
            'youtube' => $this->youtube,

            'countrie'   => $this->pays_id,
            'wilaya' => $this->wilaya_id,
            'commune'=> $this->commune_id,
            'localisation' => $this->localisation,
            
        ];
    }
}
