<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id'
    ];
    // funzione di relazione tra Post e category (one to many)
    public function category(){
        return $this->belongsTo('App\Category');
    }
    // funzione di relazione tra Post e Tag (many to many)
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
