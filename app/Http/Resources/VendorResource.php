<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DomaineVendorResource;
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
            'pays_id' => $this->pays_id,
            'wilaya_id' => $this->wilaya_id,
            'commune_id' => $this->commune_id,
        ];
    }
}
