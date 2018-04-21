<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    
    protected $table = "schedules";

    public function getStartTimeAttribute($value){
    	return date("g:i A", strtotime($value));
    }

    public function getEndTimeAttribute($value){
    	return date("g:i A", strtotime($value));
    }
}
