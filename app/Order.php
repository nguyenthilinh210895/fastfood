<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "order";
    
    public function customer(){
    	return $this->belongsTo('App\Customer', 'id_customer', 'id');
    }

    public function orderdetails(){
    	return $this->hasMany('App\OrderDetails', 'id_order', 'id');
    }

    public function table(){
    	return $this->belongsTo('App\Table', 'id_table', 'id');
    }
}
