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
            'type'          => 'articles',
            'id'            => (string)$this->id,
            'attributes'    => [
                'postTitle' => $this->postTitle,
                'slug' => $this->slug,
                'image' => $this->image,
                'introtext' => $this->introtext,
                'content' => $this->content                
            ],
        ];
    }
}
