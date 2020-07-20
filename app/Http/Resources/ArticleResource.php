<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'tag_id' => $this->tag_id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'user' => $this->user,
            'tag' => $this->tag
        ];
    }

    public function with($request)
    {
        return [
            'meta' => [
                'status' => 'ok',
                'code' => 200,
                'published' => $this->created_at->diffForHumans(),
                'updated_at' => $this->updated_at->format('d F Y')
            ]
        ];
    }
}
