<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DomaineVendorResource;
use  App\Http\Resources\CommuneResource;
use  App\Http\Resources\PaysResource;
use  App\Http\Resources\WilayasResource;
class VendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'email' => $this->email,
            'domaine_vendeur' => $this->domaine_vendeur,
            'store_name' => $this->store_name,
            'livraison' => $this->livraison,
            'phone' => $this->phone,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'tiktok' => $this->tiktok,
            'youtube' => $this->youtube,
            'countrie'   => new PaysResource($this->countrie),
            'wilaya' => new WilayasResource($this->wilaya),
            'commune'=> new CommuneResource($this->commune),
        ];
    }
}
