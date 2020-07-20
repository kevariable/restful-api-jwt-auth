<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ArticleResource::collection($this->collection);
    }

    public function with($request)
    {
        return [
            'meta' => [
                'status' => 'ok',
                'code' => 200,
                'article_count' => $this->collection->count()
            ]
        ];
    }
}
