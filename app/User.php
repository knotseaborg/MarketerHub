<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function projects(){
        return $this->hasMany('App\Project')->withTimeStamp();
    }

    public function tags(){
        return $this->belongsToMany('App\Tag')->withPivot('type')->withTimestamps();
    }

    //Custom methods to obtain desired data
    public function provides(){
        return $this->belongsToMany('App\Tag')->wherePivot('type', 'provides');   
    }

    public function requires(){
        return $this->belongsToMany('App\Tag')->wherePivot('type', 'requires');   
    }    

    //Will have to change it
    public function invites_sent(){
        return $this->hasMany('App\Invite', 'sender_id');
    }

    public function invites_received(){
        return $this->hasMany('App\Invite', 'receiver_id');
    }

    public function comments(){
        return $this->hasMany('App\Comment', 'user_id');
    }

    public function setting(){
        return $this->hasOne('App\Setting', 'user_id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id', //Added role_id to fillable so that the user can select it.
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
