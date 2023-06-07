<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'site_name'  => $this->site_name,
            'address'  => $this->address,
            'email'  => $this->email,
            'phone'  => $this->phone,
            'facebook_page'  => $this->facebook_page,
            'facebook_groupe'  => $this->facebook_groupe,
            'instagram'  => $this->instagram,
            'tiktok'  => $this->tiktok,
            'youtube'  => $this->youtube,
            'logo'  => $this->logo,
            'video'  => $this->video,
            'image'  => $this->image,
            'gerant_name'  => $this->gerant_name,
            'description'  => $this->description,
        ];
    }
}













