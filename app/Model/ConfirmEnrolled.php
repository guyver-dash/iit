<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ConfirmEnrolled extends Model
{
    protected $table = 'confirm_enrolled';

    protected $fillable = [
    	'course_id', 'student_type_id','enrollee_id', 'school_year_id', 'year_level_id', 'semester_id',
    	'schedule_id', 'start_time', 'end_time'
    ];

    public function schoolYear(){
        return $this->hasOne('App\Model\SchoolYear', 'id', 'school_year_id');
    }

    public function enrollee(){

    	return $this->hasOne('App\Model\Enrollee', 'id', 'enrollee_id');
    }

    public function yearLevel(){

    	return $this->hasOne('App\Model\YearLevel', 'id', 'year_level_id');
    }

    public function semester(){

    	return $this->hasOne('App\Model\Semester', 'id', 'semester_id');
    }

    public function schedule(){

    	return $this->hasOne('App\Model\Schedule', 'id', 'schedule_id');
    }

    public function scopePagination($query){

        return $this->scopeRelTable($query)->paginate(2);
    }

    public function scopeRelTable($query){
        return $query->with(['course', 'semester', 'schoolYear', 'schedule', 'studentType', 'enrollee.civil'])->orderBy('created_at', 'DESC');
    }

     public function course(){

        return $this->hasOne('App\Model\Course', 'id', 'course_id');
    }

    public function studentType(){
         return $this->hasOne('App\Model\StudentType', 'id', 'student_type_id');
    }
}
