<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
<<<<<<< HEAD
    //
=======

    public function languages(){
        return $this->belongsToMany(Language::class)->withTimestamps()->withPivot('id','name');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
>>>>>>> 4d1c881b0feea2ff9cff40ec255fe05297911e45
}
