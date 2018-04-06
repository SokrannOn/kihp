<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function languages()
    {
        return $this->belongsToMany(Language::class)->withTimestamps()->withPivot('id', 'title', 'main_content', 'content');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_added');
    }
}
