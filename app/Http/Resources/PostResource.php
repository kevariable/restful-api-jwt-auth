<?php

namespace App\Http\Resources;

use Illuminate\Support\Arr;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            "title" => $this->title,
            "slug" => $this->slug,
            "body" => $this->body,
            "tags" => $this->tags->pluck('name')
        ];
    }

    public function with($request)
    {
        return [
            'meta' => [
                'publish_at' => $this->created_at->diffForHumans()
            ]
        ];
    }
}
