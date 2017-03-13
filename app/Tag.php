<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function projects(){
    	return $this->belongsToMany('App\Project');
    }

    public function users(){
        return $this->belongsToMany('App\User')->withPivot('type')->withTimestamps();
    }

    public function invites(){
    	return $this->belongsToMany('App\Invite')->withTimestamps();
    }
}
