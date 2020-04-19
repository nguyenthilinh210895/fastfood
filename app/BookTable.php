<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookTable extends Model
{
    protected $table = "booktable";

    public function customer(){
    	return $this->belongsTo('App\Customer', 'id_customer', 'id');
    }

    public function table(){
    	return $this->belongsTo('App\Table', 'id_table', 'id');
    }


}
