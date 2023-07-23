<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CrecheResource;
use App\Http\Resources\ImageBlogResource;
use App\Http\Resources\CommentBlogResource;
class BlogResourceHeart extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'  => $this->id,
            'uuid'  => $this->uuid,
            'creche_id'  => $this->creche_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'video' => $this->video,
            'nbr_heart' => $this->nbr_heart,
            'nbr_view' => $this->nbr_view,
            'created_at' => $this->created_at,
        ];
    }
}
