<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photoproduct extends Model
{
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
