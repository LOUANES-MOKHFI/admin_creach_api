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
            'programme' => new ProgrammeCrecheResource($this->programme),
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'tiktok' => $this->tiktok,
            'youtube' => $this->youtube,
            'countrie'   => new PaysResource($this->countrie),
            'wilaya' => new WilayasResource($this->wilaya),
            'commune'=> new CommuneResource($this->commune),
            'localisation' => $this->localisation,
        ];
    }
}
