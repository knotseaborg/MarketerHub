<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	protected $table = 'categories';

    public function category_type(){
    	return $this->belongsTo('App\Category_type');
    }

    public function projects(){
    	return $this->belongsTo('App\Project');
    }

    public function comments(){
    	return $this->hasMany('App\Comment', 'category_id');
    }

    
}
