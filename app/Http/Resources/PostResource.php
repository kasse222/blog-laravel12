<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id' => $this->id,
        'title' => $this->title,
        'content' => $this->content,
        'tags' => TagResource::collection($this->whenLoaded('tags')),
        'user' => new UserResource($this->whenLoaded('user')), // si eager loading
        'created_at' => $this->created_at,  
    ];
    }
}
