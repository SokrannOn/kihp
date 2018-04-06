<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    public function languages(){
        return $this->belongsToMany(Language::class)->withTimestamps()->withPivot('id','name');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
