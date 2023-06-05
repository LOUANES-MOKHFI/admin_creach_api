<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProgrammeCrecheResource;

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
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'type_creche' => $this->type_creche,
            'creche_name' => $this->creche_name,
            'programme_id' => new ProgrammeCrecheResource($this->programme_id),
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'tiktok' => $this->tiktok,
            'youtube' => $this->youtube,
            'pays_id'   => $this->pays_id,
            'wilaya_id' => $this->wilaya_id,
            'commune_id'=> $this->commune_id,
        ];
    }
}
