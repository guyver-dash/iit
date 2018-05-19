<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ConfirmEnrolled extends Model
{
    protected $table = 'confirm_enrolled';

    protected $fillable = [
    	'enrollee_id', 'school_year_id', 'year_level_id', 'semester_id',
    	'schedule_id', 'start_time', 'end_time'
    ];

    public function enrollee(){

    	return $this->hasOne('App\Model\Enrollee', 'id', 'enrollee_id');
    }

}
