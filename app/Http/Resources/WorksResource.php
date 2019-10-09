<?php

namespace App\Http\Resources;

//use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

//class ArticlesResource extends ResourceCollection
class WorksResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {                
        return [
            'type'          => 'works',
            'id'            => (string)$this->id,
            'attributes'    => [
                'name' => $this->name,
                'slug' => $this->slug,
                'image' => $this->image                
            ],
        ];
    }
}
