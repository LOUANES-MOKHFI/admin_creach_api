<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\TypeUserResource;
use  App\Http\Resources\CommuneResource;
use  App\Http\Resources\PaysResource;
use  App\Http\Resources\WilayasResource;
class UserResource extends JsonResource
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
            'type_user' => new TypeUserResource($this->typeUser),
            'countrie'   => $this->pays_id,
            'wilaya' => $this->wilaya_id,
            'commune'=> $this->commune_id,
        ];
    }
}
