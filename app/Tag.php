<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
        // funzione di relazione tra Post e Tag (many to many)
        public function posts(){
            return $this->belongsToMany('App\Post');
        }

}
