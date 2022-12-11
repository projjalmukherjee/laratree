<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = ['title','parent_id'];


    public function childs() {
        return $this->hasMany(Category::class,'parent_id','id') ;
    }

    public function parent() {
        return $this->hasOne(Category::class,'id','parent_id') ;
    }
}
