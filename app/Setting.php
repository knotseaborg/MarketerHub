<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $primaryKey = 'user_id';

    public function user(){
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function location(){
    	return $this->belongsTo('App\Category', 'location');
    }

    public function sector(){
    	return $this->belongsTo('App\Category', 'sector');
    }
}
