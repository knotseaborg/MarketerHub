<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    public function tags(){
    	return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function user_sender(){
    	return $this->belongsTo('App\User', 'sender_id'); //to is the foreign key that references User
    }

    public function user_receiver(){
    	return $this->belongsTo('App\User', 'receiver_id');
    }

    public function comments(){
    	return $this->hasMany('App\Comment','post_id');
    }
}
