<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{

    public function categoryproducts()
    {
        return $this->belongsToMany(Categoryproduct::class)->withTimestamps()->withPivot('id', 'name');
    }
    public function categories(){
        return $this->belongsToMany(Category::class)->withTimestamps()->withPivot('id','name');
    }
<<<<<<< HEAD
    public function clients(){
        return $this->belongsToMany(Client::class)->withTimestamps()->withPivot('id','title','description','logo');
=======

    public function brands(){
        return $this->belongsToMany(Brand::class)->withTimestamps()->withPivot('id','name');
>>>>>>> 886dd62609c709a471eae0ac19dfc2440bac918f
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps()->withPivot('id','name','description');
    }

    public function promotions(){
        return $this->belongsToMany(Promotion::class)->withTimestamps()->withPivot('id','name','description');
    }

    public function aboutuses(){
        return $this->belongsToMany(Aboutus::class)->withTimestamps()->withPivot('id','description');

    }

}
