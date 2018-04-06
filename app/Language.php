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
    public function clients()
    {
        return $this->belongsToMany(Client::class)->withTimestamps()->withPivot('id', 'title', 'description', 'logo');
    }
    public function brands(){
        return $this->belongsToMany(Brand::class)->withTimestamps()->withPivot('id','name');
    }
    public function activities()
    {
        return $this->belongsToMany(Activity::class)->withTimestamps()->withPivot('id', 'title', 'main_content', 'content');
    }
    public function jobcategories(){
        return $this->belongsToMany(Jobcategory::class)->withTimestamps()->withPivot('id','name');
    }
    public function jobtypes(){
        return $this->belongsToMany(Jobtype::class)->withTimestamps()->withPivot('id','name');
    }
    public function careers(){
        return $this->belongsToMany(Career::class)->withTimestamps()->withPivot('id','title','description');
    }
}
