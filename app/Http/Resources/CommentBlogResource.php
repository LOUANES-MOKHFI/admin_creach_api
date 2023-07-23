<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BlogForCommentResource;
use App\Http\Resources\UserResource;

class CommentBlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'blog'  => new BlogForCommentResource($this->blog),
            'user'  => new UserResource($this->user),
            'parent_id'  => $this->parent_id,
            'comment'  => $this->comment
        ];
    }
}
