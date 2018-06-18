<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Enrollee extends Model
{
    
    protected $table = 'enrollees';
    protected $fillable = [
         'lrn', 'idno', 'admissionNo', 'firstname', 'middlename', 'lastname',
    	'suffix', 'nickname', 'age', 'birthday', 'birth_place',
    	'sex', 'civil', 'spouse_lastname', 'spouse_firstname', 'spouse_middlename',
    	'landline', 'mobile', 'email', 'religion', 'citizenship', 'present_address',
    	'present_province_id', 'present_city_id', 'present_barangay', 'present_zipcode',
    	'permanent_address', 'permanent_province_id', 'permanent_city_id', 'permanent_zipcode',
    	'civil_id', 'educ_at_id', 'father_firstname', 'father_lastname', 'father_middlename',
    	'father_occupation', 'father_contact_number', 'father_address', 'father_province_id',
    	'father_city_id', 'father_zipcode', 'mother_firstname', 'mother_lastname', 'mother_middlename',
    	'mother_occupation', 'mother_contact_number', 'mother_address', 'mother_province_id',
    	'mother_city_id', 'mother_zipcode', 'primary', 'elementary', 'name_of_school', 'school_address', 'school_province_id',
    	'school_city_id', 'school_zipcode', 'remarks'
    ];

    public function answers(){

        return $this->belongsToMany('App\Model\Answer', 'answer_enrollee', 'enrollee_id', 'answer_id');
    }


    public function requirementsDoc(){
        return $this->belongsToMany('App\Model\RequirementDoc', 'enrollee_requirements_doc', 'enrollee_id', 'requirement_doc_id');

    }

    
    public function confirmEnrolled(){

        return $this->hasOne('App\Model\ConfirmEnrolled', 'enrollee_id', 'id');
    }
    public function civil(){

        return $this->hasOne('App\Model\CivilStatus', 'id', 'civil_id');
    }

    public function city(){
        return $this->hasOne('App\Model\City', 'id', 'present_city_id');
    }

    public function province(){
        return $this->hasOne('App\Model\Province', 'id', 'present_province_id');
    }

    public function permanentCity(){
        return $this->hasOne('App\Model\City', 'id', 'permanent_city_id');
    }

    public function permanentProvince(){
        return $this->hasOne('App\Model\Province', 'id', 'permanent_province_id');
    }

    public function fatherCity(){
         return $this->hasOne('App\Model\City', 'id', 'father_city_id');
    }

    public function fatherProvince(){
         return $this->hasOne('App\Model\Province', 'id', 'father_province_id');
    }

    public function motherCity(){
         return $this->hasOne('App\Model\City', 'id', 'mother_city_id');
    }
    
    public function motherProvince(){
         return $this->hasOne('App\Model\Province', 'id', 'mother_province_id');
    }

    public function schoolCity(){
         return $this->hasOne('App\Model\City', 'id', 'school_city_id');
    }
    
    public function schoolProvince(){
         return $this->hasOne('App\Model\Province', 'id', 'school_province_id');
    }

   
    

    public function siblings(){

        return $this->belongsToMany('App\Model\Sibling', 'enrollee_sibling', 'enrollee_id', 'sibling_id');
    }

    public function getCreatedAtAttribute($value){
        return  Carbon::parse($value)->toDayDateTimeString();
        
    }

    public function getSexAttribute($value){

        return (int)$value;
    }
    public function getCivilAttribute($value){

        return (int)$value;
    }
}
