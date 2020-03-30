<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
	protected $table = "orderdetails";

	public function order(){
		return $this->belongsTo('App\Order', 'id_order', 'id');
	}

	public function product(){
		return $this->belongsTo('App\Product', 'id_product', 'id');
	}
}
