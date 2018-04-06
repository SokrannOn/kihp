<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoryproduct extends Model
{

    public function languages(){
        return $this->belongsToMany(Language::class)->withTimestamps()->withPivot('id','name');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function products(){
        return $this->hasMany(Product::class);
    }
}
