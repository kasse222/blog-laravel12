<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
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
        'name' => $this->name,
        'created_at' => $this->created_at->diffForHumans(),
        'updated_at' => $this->updated_at?->toISOString(),
        'posts_count' => $this->posts()->count(),
        'posts' => $this->whenLoaded('posts', function () {
            return $this->posts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'body' => $post->body,
                    'created_at' => $post->created_at?->toISOString(),
                    'updated_at' => $post->updated_at?->toISOString(),
                ];
            });
        }),
    ];
}

}
