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
        $tagsCollection = $this->tags()->get();        
        foreach ($tagsCollection as $tag) {
            $tags[] = array( 'tag_id' => $tag->id, 'name' => $tag->name );
        }
        //$tags = $this->tags()->get(['tag_id', 'name'])->toArray();
        return [
            'type'          => 'article',
            'id'            => (string)$this->id,
            'attributes'    => [
                'postTitle' => $this->postTitle,
                'slug' => $this->slug,
                'image' => $this->image,
                'introtext' => $this->introtext,
                'content' => $this->content,
                'tags' => $tags
            ],
        ];
    } 
}
