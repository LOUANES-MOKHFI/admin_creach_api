<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CrecheResource;
use App\Http\Resources\ImageBlogResource;
use App\Http\Resources\CommentBlogResource;
class BlogForCommentResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'nbr_heart' => $this->nbr_heart,
            'nbr_view' => $this->nbr_view,
        ];
    }
}
