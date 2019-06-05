<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['postTitle', 'slug', 'introtext', 'image', 'content', ];

    public function tags()
    {
      return $this->belongsToMany('App\Models\Tag', 'articles_tags');
    }
}
