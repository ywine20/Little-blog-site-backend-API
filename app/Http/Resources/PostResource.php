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
        return[
        'title' => $this->title,
        'description' => $this->description,
        'like_count' => $this->like_count,
        'view_count' => $this->views_count, // Add this line to include the view count
        'images' => $this->images->pluck('image'),

        ];
    }
}
