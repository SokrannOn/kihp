<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoryproduct extends Model
{

    public function languages(){
        return $this->belongsToMany(Language::class)->withTimestamps()->withPivot('id','name');
    }
}
