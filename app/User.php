<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name','email','active','username','password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
       return $this->belongsTo(Role::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }
    public function categories(){
        return $this->hasMany(Category::class,'user_added');
    }
    public function clients(){
        return $this->hasMany(Client::class,'user_added');
    }

    public function isAdmin(){
        if($this->role->name =="administrator"){
            return true;
        }
        return false;
    }

    public function isUser(){
        if($this->role->name =="user"){
            return true;
        }
        return false;
    }

    public function isGuest(){
        if($this->role->name =="guest"){
            return true;
        }
        return false;
    }



}
