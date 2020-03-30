<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";

    public function category(){
    	return $this->belongsTo('App\Category', 'id_category', 'id');
    }

    public function comment(){
    	return $this->hasMany('App\Comment', 'id_product', 'id');
    }
}
