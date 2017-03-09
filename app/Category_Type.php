<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_type extends Model
{

	protected $table = 'category_types'; 

    public function categories(){
    	return $this->hasMany('App\Category', 'category_type_id', 'id');
    }

}
