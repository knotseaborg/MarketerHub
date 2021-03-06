<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	public function tags(){
		return $this->belongsToMany('App\Tag');
	}

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function category(){
    	return $this->belongsTo('App\Category');
    }
}
