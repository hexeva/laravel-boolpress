<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table ='user_info';

    // FUNZIONE PER COLLEGARE USER_INFO AL MODEL PRINCIPALE USER (one to one)
    public function user(){
        return $this->belongsTo('App\User');
    }
}
