<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkResource extends JsonResource
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
            'type'          => 'work',
            'id'            => (string)$this->id,
            'attributes'    => [
                'name' => $this->name,
                'slug' => $this->slug,
                'image' => $this->image,                
                'content' => $this->content                
            ],
        ];
    }
}
