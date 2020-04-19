<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeKeeping extends Model
{
    protected $table = "timekeeping";

    public $timestamps = false;
    
    public function staff_absent(){
    	return $this->belongsTo('App\User', 'id_staff_absent', 'id');
    }

    public function staff_replace(){
    	return $this->belongsTo('App\User', 'id_staff_replace', 'id');
    }
}
